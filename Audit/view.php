<?php
include('session.php');
if ($_SESSION['auth'] == false) {
    header("Location: login.php");
    exit;
}
?>
<?php
// Database configuration
$servername = "localhost";
$username = "root"; // Update this
$password = ""; // Update this
$dbname = "audit"; // Update this

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from all_data table with search functionality
$search = isset($_GET['search']) ? $_GET['search'] : '';
$sql = "SELECT id, sr_no, issue_date, company_name, place, district_address, zone, crm_no, prepared_by, testing_date,occupier_name,factory_address,vessel_description,manufacturer,process_nature,construction_date,wall_thickness,first_use_date,safe_pressure,design_pressure,last_test_date,exposure,inaccessible_parts,examinations_tests,fittings,maintenance,calculated_pressure,repair_pressure,observations,repairs, tested_by, equipment, quantity, cft_no, frequency, due_date,
 print_date,distinguishing_number_description,use_start_date,test_certificate_date,periodic_examination_date,annealing_date,defects_found_description ,size,serial_number,mfg_first_use,service_used_for,location,pressure_opening,pressure_closing,remark FROM all_data";

if (!empty($search)) {
    $search = $conn->real_escape_string($search); // Sanitize the search input
    $sql .= " WHERE id LIKE '%$search%' 
              OR company_name LIKE '%$search%' 
              OR sr_no LIKE '%$search%' 
              OR place LIKE '%$search%' 
              OR district_address LIKE '%$search%' 
              OR zone LIKE '%$search%' 
              OR crm_no LIKE '%$search%' 
              OR prepared_by LIKE '%$search%' 
              OR testing_date LIKE '%$search%' 
              OR tested_by LIKE '%$search%' 
              OR equipment LIKE '%$search%' 
              OR quantity LIKE '%$search%' 
              OR cft_no LIKE '%$search%' 
              OR frequency LIKE '%$search%' 
              OR due_date LIKE '%$search%' 
              OR print_date LIKE '%$search%'";
}

$result = $conn->query($sql);

// Function to sanitize input
function sanitize_input($data) {
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit CFT Data</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            line-height: 1.6;
            display: flex; /* Use flexbox for layout */
        }

        .sidebar {
            width: 250px;
            background-color: #343a40;
            padding: 20px;
            color: white;
            height: 100vh; /* Full height */
            position: fixed; /* Fixed sidebar */
            overflow-y: auto; /* Enable scrolling */
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 20px;
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
            display: block;
            padding: 10px;
            border-radius: 4px;
            transition: background 0.3s, color 0.3s;
        }

        .sidebar ul li a:hover {
            background-color: #495057;
            color: white;
        }

        .container {
            margin-left: 260px; /* Leave space for the sidebar */
            width: calc(100% - 260px);
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            overflow-x: auto;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
            min-width: 120px;
        }

        th {
            background: #343a40;
            color: white;
        }

        input[type="text"],
        input[type="date"],
        input[type="number"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .button-container {
            display: flex;
            justify-content: flex-end;
            margin-top: 20px;
        }

        input[type="submit"],
        .download-button {
            background-color: #343a40;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-left: 10px;
        }

        input[type="submit"]:hover,
        .download-button:hover {
            background-color: white;
            color: black;
        }

        @media (max-width: 768px) {
            table, th, td {
                display: block;
                width: 100%;
            }

            th {
                position: relative;
            }

            tr {
                margin-bottom: 20px;
                border-bottom: 2px solid #ccc;
            }
        }
        .search-container {
    display: flex; /* Use flexbox for layout */
    align-items: center; /* Center align items vertically */
}

.search-container input[type="text"] {
    width: 250px; /* Set a fixed width for the search bar */
    padding: 8px; /* Add some padding */
    border: 1px solid #ccc; /* Border styling */
    border-radius: 4px; /* Rounded corners */
}

.search-container input[type="submit"] {
    padding: 8px 16px; /* Add padding */
    margin-left: 5px; /* Space between search bar and button */
    border: none; /* Remove border */
    background-color: #343a40; /* Button background color */
    color: white; /* Button text color */
    border-radius: 4px; /* Rounded corners */
    cursor: pointer; /* Pointer cursor on hover */
}

.search-container input[type="submit"]:hover {
    background-color:#343a40; /* D

    </style>
    <script>
        function toggleSelectAll(source) {
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');
            for (var i = 0; i < checkboxes.length; i++) {
                checkboxes[i].checked = source.checked;
            }
        }

        function downloadCSV() {
            var csvContent = "data:text/csv;charset=utf-8,";
            csvContent += "sr_no,issue_date,company_name,place,district_address,zone,crm_no,prepared_by,testing_date,tested_by,equipment,quantity,cft_no,frequency,due_date,print_date\n";
            var rows = document.querySelectorAll("table tr");
            for (var i = 1; i < rows.length; i++) {
                var checkbox = rows[i].querySelector("input[type='checkbox']");
                if (checkbox && checkbox.checked) {
                    var cells = rows[i].querySelectorAll("td");
                    var rowContent = [];
                    for (var j = 1; j < cells.length; j++) {
                        rowContent.push(cells[j].querySelector('input') ? cells[j].querySelector('input').value : cells[j].textContent);
                    }
                    csvContent += rowContent.join(",") + "\n";
                }
            }
            if (csvContent === "data:text/csv;charset=utf-8,sr_no,issue_date,company_name,place,district_address,zone,crm_no,prepared_by,testing_date,tested_by,equipment,quantity,cft_no,frequency,due_date,print_date\n") {
                alert("No records selected for download.");
                return;
            }
            var encodedUri = encodeURI(csvContent);
            var link = document.createElement("a");
            link.setAttribute("href", encodedUri);
            link.setAttribute("download", "selected_cft_data.csv");
            document.body.appendChild(link);
            link.click();
        }


    </script>
</head>
<body>
    <!-- Sidebar Section -->
    <div class="sidebar">
        <h2>Menu</h2>
        <ul>
            <li><a href="dashboard.php">Home</a></li>
            <li><a href="form.html">Form</a></li>
            <li><a href="view.php">View All Records</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <!-- Main Content Section -->
    <div class="container">
    <h1>Edit CFT Data Records</h1>
 <!-- Search Bar -->
 <div class="search-container">
        <form action="" method="GET">
            <input type="text" name="search" placeholder="Search by Company Name or Certificate No." value="<?php echo isset($_GET['search']) ? sanitize_input($_GET['search']) : ''; ?>">
            <input type="submit" value="Search">
        </form>
    </div>
   

    <form action="update_data.php" method="POST">
        <div style="overflow-x: auto;">
            <table>
                <thead>
                    <tr>
                        <th><input type="checkbox" onclick="toggleSelectAll(this)"> Select All</th>
                        <th>Certificate No.</th>
                        <th>CFT Issue Date</th>
                        <th>Company Name</th>
                        <th>Place (State)</th>
                        <th>District & Full Address</th>
                        <th>Zone</th>
                        <th>CRM No./Mode of Received Detail</th>
                        <th>Prepared By</th>
                        <th>Testing Date</th>
                        <th>Name of Occupier (or Factory)</th>
                        <th>Situation and Address of Factory</th>
                        <th>Name, Description and Distinctive Number of Pressure Vessel</th>
                        <th>Name and Address of Manufacturer</th>
                        <th>Nature of Process in which it is used</th>
                        <th>Date of Construction</th>
                        <th>Thickness of Walls</th>
                        <th>Date on which the vessel was first taken into use</th>
                        <th>Safe Working Pressure Recommended by Manufacturer</th>
                        <th>Design Pressure (If Known)</th>
                        <th>Date of Last Hydraulic Test (if any) and Pressure Applied</th>
                        <th>Is the vessel exposed to weather or damp conditions?</th>
                        <th>Inaccessible Parts (if any)</th>
                        <th>Examinations and Tests made</th>
                        <th>Are fittings and appliances in accordance with the rules?</th>
                        <th>Are all fittings and appliances properly maintained?</th>
                        <th>Repairs Required</th>
                        <th>Safe Working Pressure calculated from thickness and other data</th>
                        <th>Working pressure before repairs</th>
                        <th>Observations</th>
                        <th>Tested By</th>
                        <th>Equipment</th>
                        <th>Quantity</th>
                        <th>Condition of vessel</th>
                        <th>Frequency (Months)</th>
                        <th>Due Date</th>
                        <th>Print Date</th>

<!--yearly----------------------------------------------------------------------------->
                        <th>Distinguishing number of marks and description</th>
                        <th>Date When First Taken Into Use</th>
                        <th>Date and number of the certificate relating to any test and examination made</th>
                        <th>Date of each periodically thorough examination made</th>
                        <th>Date of annealing or other heat treatment of chain or lifting tackle</th>
                        <th>Particulars of any defects affecting safe working load</th>
                        
<!--SRV----------------------------------------------------------------------------------------------->

                        <th>Size</th>
                        <th>Sr. No.</th>
                        <th>Mfg./ First Use</th>
                        <th>Service used for</th>
                        <th>Location</th>
                        <th>Pressure Opening</th>
                        <th>Pressure Closing</th>
                        <th>Remark</th>


                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Check if there are rows returned
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
    echo "<td><input type='checkbox' name='select[]' value='" . sanitize_input($row['sr_no']) . "'></td>";
    echo "<td><input type='text' name='sr_no[]' value='" . sanitize_input($row['id']) . "' readonly></td>";
    echo "<td><input type='date' name='issue_date[]' value='" . sanitize_input($row['issue_date']) . "'></td>";
    echo "<td><input type='text' name='company_name[]' value='" . sanitize_input($row['company_name']) . "'></td>";
    echo "<td><input type='text' name='place[]' value='" . sanitize_input($row['place']) . "'></td>";
    echo "<td><input type='text' name='district_address[]' value='" . sanitize_input($row['district_address']) . "'></td>";
    echo "<td><input type='text' name='zone[]' value='" . sanitize_input($row['zone']) . "'></td>";
    echo "<td><input type='text' name='crm_no[]' value='" . sanitize_input($row['crm_no']) . "'></td>";
    echo "<td><input type='text' name='prepared_by[]' value='" . sanitize_input($row['prepared_by']) . "'></td>";
    echo "<td><input type='date' name='testing_date[]' value='" . sanitize_input($row['testing_date']) . "'></td>";
    echo "<td><input type='text' name='occupier_name[]' value='" . sanitize_input($row['occupier_name']) . "'></td>";
    echo "<td><input type='text' name='factory_address[]' value='" . sanitize_input($row['factory_address']) . "'></td>";
    echo "<td><input type='text' name='vessel_description[]' value='" . sanitize_input($row['vessel_description']) . "'></td>";
    echo "<td><input type='text' name='manufacturer[]' value='" . sanitize_input($row['manufacturer']) . "'></td>";
    echo "<td><input type='text' name='process_nature[]' value='" . sanitize_input($row['process_nature']) . "'></td>";
    echo "<td><input type='text' name='construction_date[]' value='" . sanitize_input($row['construction_date']) . "'></td>";
    echo "<td><input type='text' name='wall_thickness[]' value='" . sanitize_input($row['wall_thickness']) . "'></td>";
    echo "<td><input type='date' name='first_use_date[]' value='" . sanitize_input($row['first_use_date']) . "'></td>";
    echo "<td><input type='text' name='safe_pressure[]' value='" . sanitize_input($row['safe_pressure']) . "'></td>";
    echo "<td><input type='text' name='design_pressure[]' value='" . sanitize_input($row['design_pressure']) . "'></td>";
    echo "<td><input type='date' name='last_test_date[]' value='" . sanitize_input($row['last_test_date']) . "'></td>";
    echo "<td><input type='text' name='exposure[]' value='" . sanitize_input($row['exposure']) . "'></td>";
    echo "<td><input type='text' name='inaccessible_parts[]' value='" . sanitize_input($row['inaccessible_parts']) . "'></td>";
    echo "<td><input type='text' name='examinations_tests[]' value='" . sanitize_input($row['examinations_tests']) . "'></td>";
    echo "<td><input type='text' name='fittings[]' value='" . sanitize_input($row['fittings']) . "'></td>";
    echo "<td><input type='text' name='maintenance[]' value='" . sanitize_input($row['maintenance']) . "'></td>";
    echo "<td><input type='text' name='repairs[]' value='" . sanitize_input($row['repairs']) . "'></td>";
    echo "<td><input type='text' name='calculated_pressure[]' value='" . sanitize_input($row['calculated_pressure']) . "'></td>";
    echo "<td><input type='text' name='repair_pressure[]' value='" . sanitize_input($row['repair_pressure']) . "'></td>";
    echo "<td><input type='text' name='observations[]' value='" . sanitize_input($row['observations']) . "'></td>";
    echo "<td><input type='text' name='tested_by[]' value='" . sanitize_input($row['tested_by']) . "'></td>";
    echo "<td><input type='text' name='equipment[]' value='" . sanitize_input($row['equipment']) . "'></td>";
    echo "<td><input type='number' name='quantity[]' value='" . sanitize_input($row['quantity']) . "'></td>";
    echo "<td><input type='text' name='cft_no[]' value='" . sanitize_input($row['cft_no']) . "'></td>";
    echo "<td><input type='number' name='frequency[]' value='" . sanitize_input($row['frequency']) . "'></td>";
    echo "<td><input type='date' name='due_date[]' value='" . sanitize_input($row['due_date']) . "'></td>";
    echo "<td><input type='date' name='print_date[]' value='" . sanitize_input($row['print_date']) . "'></td>";

    echo "<td><input type='text' name='distinguishing_number_description[]' value='" . sanitize_input($row['distinguishing_number_description']) . "'></td>";
    echo "<td><input type='date' name='use_start_date[]' value='" . sanitize_input($row['use_start_date']) . "'></td>";
    echo "<td><input type='date' name='test_certificate_date[]' value='" . sanitize_input($row['test_certificate_date']) . "'></td>";
    echo "<td><input type='date' name='periodic_examination_date[]' value='" . sanitize_input($row['periodic_examination_date']) . "'></td>";
    echo "<td><input type='date' name='annealing_date[]' value='" . sanitize_input($row['annealing_date']) . "'></td>";
    echo "<td><input type='text' name='defects_found_description[]' value='" . sanitize_input($row['defects_found_description']) . "'></td>";

    echo "<td><input type='text' name='size[]' value='" . sanitize_input($row['size']) . "'></td>";
    echo "<td><input type='text' name='serial_number[]' value='" . sanitize_input($row['serial_number']) . "'></td>";
    echo "<td><input type='text' name='mfg_first_use[]' value='" . sanitize_input($row['mfg_first_use']) . "'></td>";
    echo "<td><input type='text' name='service_used_for[]' value='" . sanitize_input($row['service_used_for']) . "'></td>";
    echo "<td><input type='text' name='location[]' value='" . sanitize_input($row['location']) . "'></td>";
    echo "<td><input type='text' name='pressure_opening[]' value='" . sanitize_input($row['pressure_opening']) . "'></td>";
    echo "<td><input type='text' name='pressure_closing[]' value='" . sanitize_input($row['pressure_closing']) . "'></td>";
    echo "<td><input type='text' name='remark[]' value='" . sanitize_input($row['remark']) . "'></td>";



    echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='16'>No records found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="button-container">
            <button type="button" class="download-button" onclick="SRV_Certificate()">SRV</button>
            <button type="button" class="download-button" onclick="YEARLY_Certificate()">YEARLY  29 LE New 29-CPB & EOT-Hydra</button>
            <button type="button" class="download-button" onclick="generateCertificates()">PV New</button>
            <input type="submit" value="Update Selected" name="update">
            <button type="button" class="download-button" onclick="downloadCSV()">Download Selected</button>

        </div>
    </form>
</div>

</body>
<script>
   function generateCertificates() {
    var selectedRecords = [];
    var rows = document.querySelectorAll("table tr");

    for (var i = 1; i < rows.length; i++) {
        var checkbox = rows[i].querySelector("input[type='checkbox']");
        if (checkbox && checkbox.checked) {
            var record = {
                sr_no: rows[i].querySelector("input[name='sr_no[]']").value,
                issue_date: rows[i].querySelector("input[name='issue_date[]']").value,
                company_name: rows[i].querySelector("input[name='company_name[]']").value,
                place: rows[i].querySelector("input[name='place[]']").value,
                district_address: rows[i].querySelector("input[name='district_address[]']").value,
                zone: rows[i].querySelector("input[name='zone[]']").value,
                crm_no: rows[i].querySelector("input[name='crm_no[]']").value,
                prepared_by: rows[i].querySelector("input[name='prepared_by[]']").value,
                testing_date: rows[i].querySelector("input[name='testing_date[]']").value,
                tested_by: rows[i].querySelector("input[name='tested_by[]']").value,
                equipment: rows[i].querySelector("input[name='equipment[]']").value,
                quantity: rows[i].querySelector("input[name='quantity[]']").value,
                cft_no: rows[i].querySelector("input[name='cft_no[]']").value,
                frequency: rows[i].querySelector("input[name='frequency[]']").value,
                due_date: rows[i].querySelector("input[name='due_date[]']").value,
                print_date: rows[i].querySelector("input[name='print_date[]']").value,
                occupier_name: rows[i].querySelector("input[name='occupier_name[]']").value,
                factory_address: rows[i].querySelector("input[name='factory_address[]']").value,
                vessel_description: rows[i].querySelector("input[name='vessel_description[]']").value,
                manufacturer: rows[i].querySelector("input[name='manufacturer[]']").value,
                process_nature: rows[i].querySelector("input[name='process_nature[]']").value,
                construction_date: rows[i].querySelector("input[name='construction_date[]']").value,
                wall_thickness: rows[i].querySelector("input[name='wall_thickness[]']").value,
                first_use_date: rows[i].querySelector("input[name='first_use_date[]']").value,
                safe_pressure: rows[i].querySelector("input[name='safe_pressure[]']").value,
                design_pressure: rows[i].querySelector("input[name='design_pressure[]']").value,
                last_test_date: rows[i].querySelector("input[name='last_test_date[]']").value,
                exposure: rows[i].querySelector("input[name='exposure[]']").value,
                inaccessible_parts: rows[i].querySelector("input[name='inaccessible_parts[]']").value,
                examinations_tests: rows[i].querySelector("input[name='examinations_tests[]']").value,
                fittings: rows[i].querySelector("input[name='fittings[]']").value,
                maintenance: rows[i].querySelector("input[name='maintenance[]']").value,
                repairs: rows[i].querySelector("input[name='repairs[]']").value,
                calculated_pressure: rows[i].querySelector("input[name='calculated_pressure[]']").value,
                repair_pressure: rows[i].querySelector("input[name='repair_pressure[]']").value,
                observations: rows[i].querySelector("input[name='observations[]']").value,
            };
            selectedRecords.push(record);
        }
    }

    if (selectedRecords.length === 0) {
        alert("No records selected for certificate generation.");
        return;
    }

    // Redirect to certificate generation page with selected records as JSON
    var encodedRecords = encodeURIComponent(JSON.stringify(selectedRecords));
    window.location.href = "generate_certificate.php?data=" + encodedRecords;
}
function YEARLY_Certificate() {
    var selectedRecords = [];
    var rows = document.querySelectorAll("table tr");

    for (var i = 1; i < rows.length; i++) { // Skip header row
        var checkbox = rows[i].querySelector("input[type='checkbox']");

        if (checkbox && checkbox.checked) {
            var record = {
                occupier_name: rows[i].querySelector("input[name='occupier_name[]']")?.value || '',
                factory_address: rows[i].querySelector("input[name='factory_address[]']")?.value || '',
                distinguishing_number_description: rows[i].querySelector("input[name='distinguishing_number_description[]']")?.value || '',
                use_start_date: rows[i].querySelector("input[name='use_start_date[]']")?.value || '',
                test_certificate_date: rows[i].querySelector("input[name='test_certificate_date[]']")?.value || '',
                periodic_examination_date: rows[i].querySelector("input[name='periodic_examination_date[]']")?.value || '',
                annealing_date: rows[i].querySelector("input[name='annealing_date[]']")?.value || '',
                defects_found_description: rows[i].querySelector("input[name='defects_found_description[]']")?.value || '',
                sr_no: rows[i].querySelector("input[name='sr_no[]']")?.value || '',
                due_date: rows[i].querySelector("input[name='due_date[]']")?.value || '',
                testing_date: rows[i].querySelector("input[name='testing_date[]']")?.value || '',
                equipment: rows[i].querySelector("input[name='equipment[]']")?.value || '',
                print_date: rows[i].querySelector("input[name='print_date[]']").value,
            };
            selectedRecords.push(record);
        }
    }

    if (selectedRecords.length === 0) {
        alert("No records selected for certificate generation.");
        return;
    }

    // Redirect to certificate generation page with selected records as JSON
    var encodedRecords = encodeURIComponent(JSON.stringify(selectedRecords));
    window.location.href = "YEARLY_certificate.php?data=" + encodedRecords;
}
function SRV_Certificate() {
    var selectedRecords = [];
    var rows = document.querySelectorAll("table tr");

    for (var i = 1; i < rows.length; i++) { // Skip header row
        var checkbox = rows[i].querySelector("input[type='checkbox']");

        if (checkbox && checkbox.checked) {
            var record = {
                occupier_name: rows[i].querySelector("input[name='occupier_name[]']")?.value || '',
                factory_address: rows[i].querySelector("input[name='factory_address[]']")?.value || '',
                equipment: rows[i].querySelector("input[name='equipment[]']")?.value || '',
                size: rows[i].querySelector("input[name='size[]']")?.value || '',
                serial_number: rows[i].querySelector("input[name='serial_number[]']")?.value || '',
                mfg_first_use: rows[i].querySelector("input[name='mfg_first_use[]']")?.value || '',
                service_used_for: rows[i].querySelector("input[name='service_used_for[]']")?.value || '',
                location: rows[i].querySelector("input[name='location[]']")?.value || '',
                pressure_opening: rows[i].querySelector("input[name='pressure_opening[]']")?.value || '',
                pressure_closing: rows[i].querySelector("input[name='pressure_closing[]']")?.value || '',
                remark: rows[i].querySelector("input[name='remark[]']")?.value || '',
                sr_no: rows[i].querySelector("input[name='sr_no[]']")?.value || '',
                due_date: rows[i].querySelector("input[name='due_date[]']")?.value || '',
                testing_date: rows[i].querySelector("input[name='testing_date[]']")?.value || '',
                
                print_date: rows[i].querySelector("input[name='print_date[]']").value,
            };
            selectedRecords.push(record);
        }
    }

    if (selectedRecords.length === 0) {
        alert("No records selected for certificate generation.");
        return;
    }

    // Redirect to certificate generation page with selected records as JSON
    var encodedRecords = encodeURIComponent(JSON.stringify(selectedRecords));
    window.location.href = "SRV_certificate.php?data=" + encodedRecords;
}

 
</script>


</html>

<?php
$conn->close();
?> 