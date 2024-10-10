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

    .certificate-header {
        text-align: center;
        margin-bottom: 20px;
    }

    .certificate-header .logo {
        width: 150px;
        height: 150px;
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
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <?php
    // Decode the JSON data passed via URL
    $data = json_decode(urldecode($_GET['data']), true);

    // Initialize $sr_no before using it
    $sr_no = '';

    // Generate the certificate
    if (!empty($data)) {
        echo '<div class="certificate-container">';
        echo '<div class="certificate">';
        echo '<div class="certificate-header">';
        echo '<img src="logo.jpg" class="logo" alt="Company Logo" style="max-width: 150px; height: auto; margin-left: 15px;">'; // Logo
        echo '<h5 class="custom-heading" style="text-align: left; margin-left: 15px; margin-top: -30px;"> E N G I N E E R S  COMPETENT PERSONS,<br> SURVEYORS & VALUERS</h5>'; // Company Name
        echo '<h5 style="margin-left: 665px;margin-top: -75px;">Head Office: 2nd Floor, 9 Office Space, Omaxe Avenue Raebareilly Road, Lucknow-226025(U.P.)</h5>'; // Address
        echo '<hr style="border: 1px solid #000; margin: 10px 0;">';       
        echo '<h5>Mobile: 8573034092, 9839135093, Email: krtelko@gmail.com, admin@krtechnosafe.in, Website: www.krtechnosafe.in</h5>';
        echo '<hr style="border: 1px solid #000; margin: 10px 0;">'; 
        
        // Loop through records to extract and sanitize data
        foreach ($data as $record) {
            // Extracting and sanitizing data from the record
            $occupier_name = htmlspecialchars($record['occupier_name'] ?? '');
            $factory_address = htmlspecialchars($record['factory_address'] ?? '');
            $equipment = htmlspecialchars($record['equipment'] ?? '');
            $size = htmlspecialchars($record['size'] ?? ''); // Added size variable
            $serial_number = htmlspecialchars($record['serial_number'] ?? ''); // Corrected variable name
            $mfg_first_use = htmlspecialchars($record['mfg_first_use'] ?? ''); // Added first use variable
            $service_used_for = htmlspecialchars($record['service_used_for'] ?? ''); // Added service used variable
            $location = htmlspecialchars($record['location'] ?? ''); // Added location variable
            $pressure_opening = htmlspecialchars($record['pressure_opening'] ?? ''); // Added pressure opening variable
            $pressure_closing = htmlspecialchars($record['pressure_closing'] ?? ''); // Added pressure closing variable
            $remark = htmlspecialchars($record['remark'] ?? ''); // Added remark variable
            $print_date = htmlspecialchars($record['print_date'] ?? ''); 
            $sr_no = htmlspecialchars($record['sr_no'] ?? ''); 
            $due_date = htmlspecialchars($record['due_date'] ?? ''); 
            $testing_date = htmlspecialchars($record['testing_date'] ?? ''); 
        }

        // Display the certificate header
        echo '<div style="text-align: right;"><h5>KRTE/UP/SRV/PAV/TSV/PVRV/' . $sr_no . '/2024-25</h5></div>';

        echo '<h4>CERTIFICATE OF YEARLY TEST OF SRV/PAV/TSV/PVRV</h4>'; // Header Title
        echo '</div>';
        echo '<div class="certificate-content">';

        // Display the records
        echo "<p>1. Name of company: $occupier_name</p>";
        echo "<p>2. Address: $factory_address</p>";
        echo "<p>3. Name of the equipment: $equipment</p>"; 
        echo "<p>4. Manufacturer: $occupier_name</p>";
        echo "<p>5. Size: $size</p>";
        echo "<p>6. Sr. No: $serial_number</p>"; 
        echo "<p>7. Mfg./ First Use: $mfg_first_use</p>";
        echo "<p>8. Service used for: $service_used_for</p>";
        echo "<p>9. Location: $location</p>"; 
        echo "<p>10. Pressure Opening: $pressure_opening</p>";
        echo "<p>11. Pressure Closing: $pressure_closing</p>"; 
        echo "<p>12. Remark: $remark</p>";
        echo "<p>13. Testing date: $testing_date</p>";
        echo "<p>14. Valid upto: $due_date</p>"; 
        echo "<p>15. Print date: $print_date</p><br>"; 

        echo '</div>'; // Closing certificate-content

        // Add certification statement and signatory
        echo "<p>This is to certify that on dated $testing_date the safety valve was witnessed for popping / reset and the above is true report of our examination.<br>
    <strong>For K.R. Technosafe Engineers</strong>
        </p>";

        echo "<p><br>
        <strong>A.K.Tiwari</strong><br>
        [B.Tech, DIS, EMBA, Level-II (ASNT)]<br>
        <strong>Director/ Competent Person</strong><br></p>";

        echo "<p><strong>Competency Cft. No</strong>.- $sr_no/S.P.-UP/Org./2023, dt.$print_date, Sec.-21(2),28,29,31<br>
        <strong>DISCLAIMER:</strong> This Report of examination reflects the condition of the machine/ equipment as on date. We accept no liability / responsibility whatsoever in case of any accident / mishap on/with/ due to this machine / equipment.</p>";

       
    } else {
        echo "<h5>No data found to display.</h5>"; // Message when no data is available
    }
    ?>
</div>
