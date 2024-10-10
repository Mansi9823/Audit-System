<?php
include('session.php');
if ($_SESSION['auth'] == false) {
    header("Location: login.php");
    exit;
}

// Database configuration
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

// Prepare and bind for inserting main data
$stmt = $conn->prepare("INSERT INTO all_data (sr_no, issue_date, company_name, place, district_address, zone, crm_no, prepared_by, testing_date, tested_by, equipment, quantity, cft_no, frequency, due_date, print_date, occupier_name, factory_address, vessel_description,manufacturer,process_nature,construction_date,wall_thickness,first_use_date,safe_pressure,design_pressure,last_test_date,exposure,inaccessible_parts,examinations_tests,fittings,maintenance,repairs,calculated_pressure,repair_pressure,observations,distinguishing_number_description,
test_certificate_date,periodic_examination_date,annealing_date,defects_found_description,use_start_date,size,serial_number,mfg_first_use,service_used_for,location,pressure_opening,pressure_closing,remark) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

$stmt->bind_param("isssssssssssisssssssssssssssssssssssssssssssssssss", $sr_no, $issue_date, $company_name, $place, 
$district_address, $zone, $crm_no, $prepared_by, $testing_date, $tested_by, $equipment, $quantity, $cft_no, $frequency, $due_date, 
$print_date,$occupier_name,$factory_address, $vessel_description,$manufacturer,$process_nature,$construction_date,$wall_thickness,
$first_use_date,$safe_pressure,$design_pressure,$last_test_date,$exposure,$inaccessible_parts,$examinations_tests,$fittings,$maintenance,
$repairs,$calculated_pressure,$repair_pressure,$observations,$distinguishing_number_description,$test_certificate_date,$periodic_examination_date,$annealing_date,$defects_found_description,$use_start_date,$size,
$serial_number,$mfg_first_use,$service_used_for,$location,$pressure_opening,$pressure_closing,$remark);

// Get form data
$sr_no = $_POST['sr_no'];
$issue_date = $_POST['issue_date'];
$company_name = $_POST['company_name'];
$place = $_POST['place'];
$district_address = $_POST['district_address'];
$zone = $_POST['zone'];
$crm_no = $_POST['crm_no'];
$prepared_by = $_POST['prepared_by'];
$testing_date = $_POST['testing_date'];
$tested_by = $_POST['tested_by'];
$equipment = $_POST['equipment'];
$quantity = $_POST['quantity'];
$cft_no = $_POST['cft_no'];
$frequency = $_POST['frequency'];
$due_date = $_POST['due_date'];
$print_date = $_POST['print_date'];
$occupier_name =$_POST['occupier_name'];
$factory_address =$_POST['factory_address'];
$vessel_description =$_POST['vessel_description'];
$manufacturer =$_POST['manufacturer'];
$process_nature =$_POST['process_nature'];
$construction_date =$_POST['construction_date'];
$wall_thickness =$_POST['wall_thickness'];
$first_use_date=$_POST['first_use_date'];
$safe_pressure=$_POST['safe_pressure'];
$design_pressure=$_POST['design_pressure'];
$last_test_date=$_POST['last_test_date'];
$exposure=$_POST['exposure'];
$inaccessible_parts=$_POST['inaccessible_parts'];
$examinations_tests=$_POST['examinations_tests'];
$fittings=$_POST['fittings'];
$maintenance=$_POST['maintenance'];
$repairs=$_POST['repairs'];
$calculated_pressure=$_POST['calculated_pressure'];
$repair_pressure=$_POST['repair_pressure'];
$observations=$_POST['observations'];

$distinguishing_number_description=$_POST['distinguishing_number_description'];
$test_certificate_date=$_POST['test_certificate_date'];
$periodic_examination_date=$_POST['periodic_examination_date'];
$annealing_date=$_POST['annealing_date'];
$defects_found_description=$_POST['defects_found_description'];
$use_start_date = isset($_POST['use_start_date']) ? $_POST['use_start_date'] : null;

$size=$_POST['size'];
$serial_number=$_POST['serial_number'];
$mfg_first_use=$_POST['mfg_first_use'];
$service_used_for=$_POST['service_used_for'];
$location=$_POST['location'];
$pressure_opening=$_POST['pressure_opening'];
$pressure_closing=$_POST['pressure_closing'];
$remark=$_POST['remark'];
// Initialize message variables
$message = '';
$messageType = '';

// Execute the statement
if ($stmt->execute()) {
    $message = "New record created successfully";
    $messageType = "success";
} else {
    $message = "Error: " . $stmt->error;
    $messageType = "error";
}

// Close statement and connection
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message</title>
    <style>
        body {
            font-family: 'Orbitron', sans-serif;
            background-color: #f4f7f6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .message-box {
            background-color: #fff;
            padding: 20px 40px;
            border-radius: 8px;
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 400px;
            font-family: 'Ubuntu', sans-serif;
        }
        .message-box.success {
            border-left: 6px solid #4caf50;
        }
        .message-box.error {
            border-left: 6px solid #f44336;
        }
        h2 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }
        p {
            font-size: 16px;
            margin-top: 10px;
            color: #555;
        }
        .success-icon, .error-icon {
            font-size: 50px;
            margin-bottom: 15px;
        }
        .success-icon {
            color: #4caf50;
        }
        .error-icon {
            color: #f44336;
        }
        .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #4caf50;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div class="message-box <?php echo $messageType; ?>">
    <?php if ($messageType == 'success') { ?>
        <div class="success-icon">✔</div>
    <?php } else { ?>
        <div class="error-icon">✖</div>
    <?php } ?>
    
    <h2><?php echo $message; ?></h2>
    <p>Your form has been successfully submitted.</p>

    <a href="form.html" class="btn">Go Back</a>
</div>

</body>
</html>
