<?php
include('session.php');

if ($_SESSION['auth'] == false) {
    header("Location: login.php");
    exit;
}

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
// echo '<pre>'; print_r($_POST);die;
// Check if form is submitted
if (isset($_POST['update'])) {
    // Loop through selected records
    foreach ($_POST['sr_no'] as $index => $sr_no) {
        // Prepare data for update
        $slno = $_POST['sr_no'][$index];
        $issue_date = $_POST['issue_date'][$index];
        $company_name = $_POST['company_name'][$index];
        $place = $_POST['place'][$index];
        $district_address = $_POST['district_address'][$index];
        $zone = $_POST['zone'][$index];
        $crm_no = $_POST['crm_no'][$index];
        $prepared_by = $_POST['prepared_by'][$index];
        $testing_date = $_POST['testing_date'][$index];
        $tested_by = $_POST['tested_by'][$index];
        $equipment = $_POST['equipment'][$index];
        $quantity = $_POST['quantity'][$index];
        $cft_no = $_POST['cft_no'][$index];
        $frequency = $_POST['frequency'][$index];
        $due_date = $_POST['due_date'][$index];
        $print_date = $_POST['print_date'][$index];

        $sql = "UPDATE all_data SET 
            issue_date = '$issue_date', 
            company_name = '$company_name', 
            place = '$place', 
            district_address = '$district_address', 
            `zone` =  '$zone', 
            crm_no = '$crm_no', 
            prepared_by = '$prepared_by', 
            testing_date ='$testing_date', 
            tested_by = '$tested_by', 
            equipment = '$equipment', 
            quantity ='$quantity', 
            cft_no = '$cft_no', 
            frequency = '$frequency', 
            due_date = '$due_date', 
            print_date ='$print_date'
            WHERE id = $slno";
    
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            echo "Error updating record: " . $stmt->error;
        }
        // Prepare statement
        // $stmt = $conn->prepare($sql);
        
        // // Check if the statement was prepared successfully
        // if ($stmt === false) {
        //     die("Error preparing statement: " . $conn->error);
        // }

        // // Bind parameters
        // $stmt->bind_param("ssssssssssssssss", $issue_date, $company_name, $place, $district_address, $zone, $crm_no, $prepared_by, $testing_date, $tested_by, $equipment, $quantity, $cft_no, $frequency, $due_date, $print_date, $sr_no);
        
        // Execute the statement
        // if (!$stmt->execute()) {
        //     echo "Error updating record: " . $stmt->error;
        // }
    }
;
    // Redirect or display success message
    header("Location: view.php"); // Redirect to view page after update
    exit;
}

$conn->close();
?>
