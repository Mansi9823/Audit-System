<style>
    body {
        font-family: 'Roboto', sans-serif;
        background-color: #f4f4f9;
        margin: 0;
        padding: 0;
    }

    .wrapper {
        display: flex;
        height: 160vh; /* Full viewport height */
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

    .certificate-container {
        padding: 50px;
        width: 1024px;
        margin: 0 auto;
    }

    .certificate {
        border: 20px solid #343a40;
        padding: 25px;
        position: relative;
        background-color: #fff;
    }

    .certificate:after {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: url(https://image.ibb.co/ckrVv7/water_mark_logo.png);
        background-size: 100%;
        opacity: 0.1;
        z-index: -1;
    }

    .certificate-header .logo {
        width: 150px;
        height: 150px;
        margin left: 10px
        margin: 0 auto;
        display: block;
    }

    .certificate-title {
        text-align: center;
    }

    h1 {
        font-weight: 400;
        font-size: 48px;
        color: #343a40;
        text-align: center;
    }

    .certificate-content {
        margin: 0 auto;
        width: 750px;
    }

    .about-certificate {
        width: 380px;
        margin: 0 auto;
    }

    .topic-description {
        text-align: center;
    }

    .certificate-footer {
        color: gray;
        margin-top: 20px;
    }

    .text-center {
        text-align: center;
    }

    .row {
        display: flex;
        justify-content: space-between;
        margin: 20px 0;
    }

    .col-md-6 {
        width: 48%;
    }

    .action-button {
        background-color: #343a40;
        color: white;
        border: none;
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
        margin-top: 20px;
    }

    .action-button:hover {
        background-color: #0A3D67;
    }

    /* Hiding sidebar and unnecessary elements during print */
    @media print {
        .sidebar {
            display: none;
        }
        .wrapper {
            display: block;
        }
        .action-button {
            display: none;
        }
    }
    .logo {
    width: 200px; /* Change this value to your desired width */
    height: auto; /* Keeps the aspect ratio */
}
.custom-heading {
    margin-top: 10px; /* Adjust this value for top spacing */
    margin-left: 300px; /* Adjust this value for left spacing */
}

</style>


<div class="wrapper">
    <!-- Sidebar Section -->
    <div class="sidebar">
        <h2>Menu</h2>
        <ul>
            <li><a href="dashboard.php">Home</a></li>
            
            <li><a href="form.html">Form</a></li>
            <li><a href="view.php">View All Records</a></li>
            <!--<li><a href="audit_certificate.html">Certificate</a></li>-->
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <?php
    // Decode the JSON data passed via URL
    $data = json_decode(urldecode($_GET['data']), true);

    // Generate the certificate
    if (!empty($data)) {
        echo '<div class="certificate-container">';
        echo '<div class="certificate">';
        echo '<div class="certificate-header">';
        echo '<img src="logo.jpg" class="logo" alt="Company Logo">';
        echo '</div>';
        echo '<div class="certificate-body">';
        echo '<h2 class="custom-heading">K R Technosafe Engineers</h2>';

        echo '<h1>Certificate of Inspection</h1>';


        echo '<p class="certificate-title"><strong>' . htmlspecialchars($data[0]['company_name']) . '</strong></p>';
        foreach ($data as $record) {
            // Extracting and sanitizing data from the record
            $sr_no = htmlspecialchars($record['sr_no']);
            $issue_date = htmlspecialchars($record['issue_date']);
            $place = htmlspecialchars($record['place']);
            $district_address = htmlspecialchars($record['district_address']);
            $zone = htmlspecialchars($record['zone']);
            $crm_no = htmlspecialchars($record['crm_no']);
            $prepared_by = htmlspecialchars($record['prepared_by']);
            $testing_date = htmlspecialchars($record['testing_date']);
            $tested_by = htmlspecialchars($record['tested_by']);
            $equipment = htmlspecialchars($record['equipment']);
            $quantity = htmlspecialchars($record['quantity']);
            $cft_no = htmlspecialchars($record['cft_no']);
            $frequency = htmlspecialchars($record['frequency']);
            $due_date = htmlspecialchars($record['due_date']);
            $print_date = htmlspecialchars($record['print_date']);
        
            // Add inspection and validity information
            $valid_until = date('Y-m-d', strtotime($testing_date . ' + ' . $frequency . ' months'));
        
            echo '<div class="certificate-content">';
            echo "<h2>Certificate No: $sr_no</h2>";
            echo "<p><strong>Issue Date:</strong> $issue_date</p>";
            echo "<p><strong>We have conducted tests on:</strong> $testing_date</p>"; // Testing date
            echo "<p><strong>This certificate is valid until:</strong> $valid_until</p>"; // Validity date
            echo "<p><strong>Place:</strong> $place</p>";
            echo "<p><strong>District Address:</strong> $district_address</p>";
            echo "<p><strong>Zone:</strong> $zone</p>";
            echo "<p><strong>CRM No:</strong> $crm_no</p>";
            echo "<p><strong>Prepared By:</strong> $prepared_by</p>";
            echo "<p><strong>Tested By:</strong> $tested_by</p>";
            echo "<p><strong>Equipment:</strong> $equipment</p>";
            echo "<p><strong>Quantity:</strong> $quantity</p>";
            echo "<p><strong>CFT No:</strong> $cft_no</p>";
            echo "<p><strong>Frequency (Months):</strong> $frequency</p>";
            echo "<p><strong>Due Date:</strong> $due_date</p>";
            echo "<p><strong>Print Date:</strong> $print_date</p>";
            echo '</div>'; // .certificate-content
        }
        

        echo '<div class="certificate-footer text-center">';
        echo '<div class="row">';
        echo '<div class="col-md-6">';
        echo '<p>Principal: ______________________</p>';
        echo '</div>';
        echo '<div class="col-md-6">';
        echo '<p>Accredited by: ______________________</p>';
        echo '</div>';
        echo '</div>'; // .row
        echo '</div>'; // .certificate-footer

        // Add action button
        echo '<div class="text-center">';
        echo '<button class="action-button" onclick="window.print()">Print Certificate</button>';
        echo '</div>';

        echo '</div>'; // .certificate-body
        echo '</div>'; // .certificate
        echo '</div>'; // .certificate-container

    } else {
        echo '<div style="text-align: center; font-size: 20px; color: red;">No data provided.</div>';
    }
    ?>
</div>
