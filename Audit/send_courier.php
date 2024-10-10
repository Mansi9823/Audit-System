<?php
// send_courier.php
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reference_number = $_POST['reference_number'];
    $sender_name = $_POST['sender_name'];
    $sender_address = $_POST['sender_address'];
    $recipient_name = $_POST['recipient_name'];
    $recipient_address = $_POST['recipient_address'];
    $recipient_contact = $_POST['recipient_contact'];
    $type = $_POST['type'];
    $weight = $_POST['weight'];
    $price = $_POST['price'];

    // Prepare and execute the SQL statement
    $sql = "INSERT INTO courier (reference_number, sender_name, sender_address, recipient_name, recipient_address, recipient_contact, type, weight, price) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssssssssis", $reference_number, $sender_name, $sender_address, $recipient_name, $recipient_address, $recipient_contact, $type, $weight, $price);
        
        if ($stmt->execute()) {
            echo "Certificate sent via courier successfully!";
        } else {
            echo "Error: Could not send certificate.";
        }
        $stmt->close();
    }
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
