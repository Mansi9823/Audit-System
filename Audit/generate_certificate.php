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

    // Generate the certificate
    if (!empty($data)) {
        echo '<div class="certificate-container">';
        echo '<div class="certificate">';
        echo '<div class="certificate-header">';
        echo '<img src="logo.jpg" class="logo" alt="Company Logo" style="max-width: 150px; height: auto; margin-left: 15px;">'; // Logo
        echo '<h5 class="custom-heading" style="text-align: left; margin-left: 15px; margin-top: -30px;"> E N G I N E E R S  COMPETENT PERSONS,<br> SURVEYORS & VALUERS</h5>'; // Company Name
        echo '<h5 style="margin-left: 665px;margin-top: -75px;">Head Office: 2nd Floor, 9 Office 
        Space, Omaxe Avenue Raebareilly Road, Lucknow-226025(U.P.)</h5>'; // Address
        echo '<hr style="border: 1px solid #000; margin: 10px 0;">'; 




        
        echo '<h5>Mobile :8573034092, 9839135093, Email: krtelko@gmail.com, admin@krtechnosafe.in , Website: www.krtechnosafe.in</h5>';
        echo '<hr style="border: 1px solid #000; margin: 10px 0;">'; 
        echo '<h4>FORM NO. 9<br>
(Prescribed under Rule 56 of U.P. Factory Rules 1950)<br> Report of examination of Pressure Vessel
</h4>'; // Header Title
        echo '</div>';
        echo '<div class="certificate-body">';

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

            // Additional fields for pressure vessels
            $occupier_name = htmlspecialchars($record['occupier_name']);
            $factory_address = htmlspecialchars($record['factory_address']);
            $vessel_description = htmlspecialchars($record['vessel_description']);
            $manufacturer = htmlspecialchars($record['manufacturer']);
            $process_nature = htmlspecialchars($record['process_nature']);
            $construction_date = htmlspecialchars($record['construction_date']);
            $wall_thickness = htmlspecialchars($record['wall_thickness']);
            $first_use_date = htmlspecialchars($record['first_use_date']);
            $safe_pressure = htmlspecialchars($record['safe_pressure']);
            $design_pressure = htmlspecialchars($record['design_pressure']);
            $last_test_date = htmlspecialchars($record['last_test_date']);
            $exposure = htmlspecialchars($record['exposure']);
            $inaccessible_parts = htmlspecialchars($record['inaccessible_parts']);
            $examinations_tests = htmlspecialchars($record['examinations_tests']);
            $fittings = htmlspecialchars($record['fittings']);
            $maintenance = htmlspecialchars($record['maintenance']);
            $repairs = htmlspecialchars($record['repairs']);
            $calculated_pressure = htmlspecialchars($record['calculated_pressure']);
            $repair_pressure = htmlspecialchars($record['repair_pressure']);
            $observations = htmlspecialchars($record['observations']);

            // Add inspection and validity information
            $valid_until = date('Y-m-d', strtotime($testing_date . ' + ' . $frequency . ' months'));

            // Display certificate details
            echo "<p>1.	Name of occupier (or Factory): $occupier_name</p>";
            echo "<p>2.	Situation and address of Factory: $factory_address</p>";
            echo "<p>3.	Name description and distinctive number of Pressure Vessel: $vessel_description</p>";   
            echo "<p>4.	Name and Address of Manufacturer: $manufacturer</p>";
            echo "<p>5.	Nature of process in which it is used:$process_nature</p>";
            echo "<p>6.	Particulars of vessel:<br>
                              a)	Date of construction: $construction_date</p>";
            echo "<p>b)	Thickness of walls:$wall_thickness</p>";
            echo "<p>c)	Date on which the vessel was first taken into use: $first_use_date</p>";
            echo "<p>d)	Safe working pressure recommended by the manufacturer: $safe_pressure</p>";
            echo "<p>e)	Design pressure (If Known)<br>
(The history should be briefly given and the examiner should state whether he has seen the last/Previous report)
:</strong> $design_pressure</p>";
            echo "<p>7.	Date of last Hyd.test(if any) and pressure applied: $last_test_date</p>";
            echo "<p>8.	Is the vessel in open or otherwise exposed to weather or to damp $exposure</p>";
            echo "<p>9.	What parts (if any) were inaccessible?$inaccessible_parts</p>";
            echo "<p>10.	What examination and tests were made?<br>
            [Specify pressure if Hydraulic test was carried out]
            :</strong> $examinations_tests</p>";
            echo "<p>11.	Condition of vessel [state any external defects materially affecting the safe working pressure or the internal safe working of the vessel.]$cft_no</p>";
            echo "<p>12.	Are the fittings and appliances provided in accordance with the rules for pressure vessel?:$fittings</p>";
            echo "<p>13.	Are all fittings and appliances properly maintained and in good condition: $maintenance</p>";
            echo "<p>14.	Repairs <br>[if any required and period within which they should be executed and any other condition which the person making the examination thinks is necessary to rectify for securing Safe working]: $repairs</p>";
            echo "<p>15.	Safe working pressure calculated from dimensions and from the thickness and other data ascertained by the present examination, due allowance being made for condition of working if unusual or exceptionally severe<br>[state minimum thickness of walls measured during examination]:$calculated_pressure</p>";
            echo "<p>16.	Where repair affecting the safe working pressure are required, state the working pressure before the expiration of the period specified in [11]: $repair_pressure</p>";
            echo "<p>17.	other observations: $observations</p>";



echo"<p>I/We certify that on $testing_date the pressure vessels described above was 
thoroughly cleaned and (so far its construction permits) made accessible for thorough 
examination and for such tests as were necessary for thorough examination and that on the said date.
I/We thoroughly examined this pressure vessel including its fitting and that the result is true report of my examination.<br>

<strong>Certificate No.</strong> - KRTE/LKO/PV/ $sr_no/2024-25<br>
<strong>Valid upto:</strong> $due_date
</p>";

echo"<p><br>
<strong>
A.K.Tiwari</strong><br>

[B.Tech, DIS, EMBA, Level-II (ASNT)]<br>
<strong>
Director/ Competent Person</strong><br></p>";


echo"<p><strong>Competency Cft. No</strong>.- $sr_no/S.P.-UP/Org./2023, dt.$print_date, Sec.-21(2),28,29,31<br>
<strong>DISCLAIMER:</strong> This Report of examination reflects the condition of the machine/ equipment as 
on date. We accept no liability / responsibility whatsoever in case of any accident / mishap on/with/ due to this machine / equipment.</p>";






          
          

            echo '</div>'; // .certificate-content
        }

        echo '</div>'; // .certificate-body
        echo '<div class="certificate-footer">';
        echo '<div class="text-center">';
        echo '<button class="action-button" onclick="window.print()">Print Certificate</button>';
        echo '</div>';
        echo '</div>'; // .certificate-footer
        echo '</div>'; // .certificate
        echo '</div>'; // .certificate-container
    } else {
        echo '<div style="text-align: center; font-size: 20px; color: red;">No data provided.</div>';
    }
    ?>
</div>
