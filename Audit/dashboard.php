<?php
include('session.php');

// Check if user is authenticated
if (!isset($_SESSION['auth']) || $_SESSION['auth'] == false) {
    header("Location: login.php");
    exit;
}

// Database connection
$servername = "localhost"; // Database server
$username = "root"; // Database username
$password = ""; // Database password
$dbname = "audit"; // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle the CSV download
if (isset($_POST['download_csv'])) {
    // Check if any checkboxes were selected
    if (isset($_POST['selected_records']) && is_array($_POST['selected_records'])) {
        // Create a CSV file
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="due_dates_' . date('Ymd_His') . '.csv"');

        $output = fopen('php://output', 'w');
        fputcsv($output, ['Company Name', 'Due Date']); // Header row

        // Write data to CSV for selected records
        foreach ($_POST['selected_records'] as $recordId) {
            $notificationQuery = $conn->prepare("SELECT company_name, due_date FROM all_data WHERE id = ?");
            $notificationQuery->bind_param("i", $recordId);
            $notificationQuery->execute();
            $result = $notificationQuery->get_result();
            if ($row = $result->fetch_assoc()) {
                fputcsv($output, [$row['company_name'], $row['due_date']]);
            }
        }

        fclose($output);
        exit;
    } else {
        // No records selected
        echo "<script>alert('Please select at least one record to download.');</script>";
    }
}

// Fetch notifications for due dates
$currentDate = date('Y-m-d');
$notificationQuery = $conn->prepare("SELECT id, company_name, due_date FROM all_data WHERE due_date BETWEEN ? AND DATE_ADD(?, INTERVAL 6 DAY)");
$notificationQuery->bind_param("ss", $currentDate, $currentDate);
$notificationQuery->execute();
$notifications = $notificationQuery->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Dashboard</title>
    <style>
      body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .wrapper {
            display: flex;
            height: 100vh; /* Full viewport height */
        }

        .sidebar {
            width: 250px;
            background-color: #343a40;
            padding: 20px;
            color: white;
            box-sizing: border-box;
            transition: width 0.3s; /* Smooth width transition */
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
            color: #ffffff;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            margin: 10px 0;
        }

        .sidebar ul li a {
            color: #cfd8dc;
            text-decoration: none;
            font-size: 16px;
            display: flex;
            align-items: center; /* Center vertically */
            padding: 10px;
            border-radius: 4px;
            transition: background 0.3s, color 0.3s;
        }

        .sidebar ul li a:hover {
            background-color: #495057;
            color: white;
        }

        .container {
            flex: 1;
            padding: 20px;
            background: white;
            margin: 20px;
            border-radius: 8px;
            box-sizing: border-box;
            display: flex;
            flex-direction: column; /* Changed to column */
            gap: 20px; /* Space between sections */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Added shadow */
        }

        
        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
            font-size: 28px;
        }

        .date-time {
            text-align: center;
            font-size: 18px;
            margin: 10px 0; /* Space above and below the date */
            color: #555; /* Slightly lighter color for contrast */
        }

        /* Notification Section */
        .notification-title {
            font-size: 24px;
            color: #333;
            text-align: center;
        }

        .notification {
            background-color: #e7f3fe; /* Light blue background */
            border-left: 6px solid #343a40; /* Blue left border */
            padding: 15px;
            margin: 10px 0;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .sidebar {
                width: 200px; /* Adjusted width */
            }
        }

        @media (max-width: 480px) {
            .sidebar {
                width: 100%; /* Full width on small screens */
            }
            .wrapper {
                flex-direction: column; /* Stack the sidebar and content */
            }
        }
        .notification-table {
    width: 100%;
    border-collapse: collapse; /* Ensures borders are combined */
}

.notification-header {
    background-color: #f1f1f1; /* Header background color */
    font-weight: bold; /* Bold text for headers */
}

.notification {
    display: flex; /* Allows for a flexbox layout */
    padding: 10px; /* Space around notifications */
    border-bottom: 1px solid #ddd; /* Border between notifications */
}

.cell {
    flex: 1; /* Makes each cell take equal space */
    padding: 5px; /* Padding around cell content */
}

.header-cell {
    flex: 1; /* Makes header cells take equal space */
    padding: 5px; /* Padding around header content */
}
/* General Styles */
body {
    font-family: 'Ubuntu', sans-serif; /* Use Ubuntu font */
    background-color: #f9f9f9; /* Light background for better contrast */
    margin: 0;
    padding: 20px;
}

/* Form Styles */
form {
    background-color: #fff; /* White background for the form */
    border-radius: 8px; /* Rounded corners */
    padding: 20px; /* Padding around the form content */
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
}

/* Table Styles */
table {
    width: 100%; /* Full-width table */
    border-collapse: collapse; /* Remove gaps between table cells */
    margin-top: 20px; /* Space between form and table */
}

thead {
    background-color: #4CAF50; /* Green background for the header */
    color: black; /* White text color for header */
}

th, td {
    padding: 12px; /* Padding for cells */
    text-align: left; /* Align text to the left */
    border-bottom: 1px solid #ddd; /* Bottom border for rows */
}

tr:hover {
    background-color: #f2f2f2; /* Highlight row on hover */
}

.notification {
    color: #ff0000; /* Red color for notifications */
    font-weight: bold; /* Bold text for emphasis */
    margin-top: 20px; /* Space above notification */
}

/* Button Styles */
.btn {
    background-color: #4CAF50; /* Green background for button */
    color: white; /* White text color for button */
    border: none; /* No border */
    border-radius: 4px; /* Rounded corners */
    padding: 10px 20px; /* Padding for button */
    cursor: pointer; /* Pointer cursor on hover */
    font-size: 16px; /* Font size for button */
    transition: background-color 0.3s; /* Smooth transition */
}

.btn:hover {
    background-color: #45a049; /* Darker green on hover */
}

    </style>
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar Section -->
        <div class="sidebar">
            <h2>Menu</h2>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="form.html">Form</a></li>
                <li><a href="view.php">View All Records</a></li>
                <!--<li><a href="audit_certificate.html">Certificate</a></li>-->
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>

        <!-- Main Content Section -->
        <div class="container">
            <img src="logo.jpg" alt="Company Logo" class="logo" style="max-width: 150px; margin: 0 auto; display: block;">
            <div class="date-time">
                <?php echo date('l, F j, Y h:i A'); // Display current date and time ?>
            </div>

            <!-- Notification Section -->
            <h2 class="notification-title">Upcoming Due Dates</h2>
            <div class="notifications">
            <form method="post">
                    <?php if ($notifications->num_rows > 0): ?>
                        <table>
                            <thead>
                                <tr>
                                    <th>
                                        <input type="checkbox" onclick="toggleCheckboxes(this)" />
                                    </th>
                                    <th>Company Name</th>
                                    <th>Due Date</th>
                                </tr>
                            </thead>
                            <tbody>
    <?php while ($row = $notifications->fetch_assoc()): ?>
        <tr>
            <td>
                <input type="checkbox" name="selected_records[]" value="<?php echo htmlspecialchars($row['id']); ?>" id="record_<?php echo htmlspecialchars($row['id']); ?>">
            </td>
            <td>
                <label for="record_<?php echo htmlspecialchars($row['id']); ?>">
                    <strong><?php echo htmlspecialchars($row['company_name']); ?></strong>
                </label>
            </td>
            <td>
                <span style="color: red;"><?php echo htmlspecialchars($row['due_date']); ?></span> <!-- Set due date color to red -->
            </td>
        </tr>
    <?php endwhile; ?>
</tbody>

                        </table>
                    <?php else: ?>
                        <div class="notification">
                            <strong>No upcoming due dates in the next 6 days.</strong>
                        </div>
                    <?php endif; ?>
                    <!-- CSV Download Button -->
                    <button type="submit" name="download_csv" class="btn" style="margin-top: 20px;">Download Due Dates as CSV</button>
                </form>
            </div>
        </div>
    </div>

    <?php
    // Close the database connection
    $notificationQuery->close();
    $conn->close();
    ?>
</body>
<script>  function toggleCheckboxes(source) {
            const checkboxes = document.querySelectorAll('input[name="selected_records[]"]');
            checkboxes.forEach((checkbox) => {
                checkbox.checked = source.checked;
            });
        }</script>
</html>
