<?php
session_start();
// Include your database connection and other necessary files

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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];

    // Check if the email exists in your database
    $stmt = $conn->prepare("SELECT * FROM admin_user WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Generate OTP
        $otp = rand(100000, 999999);
        
        // Save OTP and email in session for simplicity (store in DB in real applications)
        $_SESSION['otp'] = $otp;
        $_SESSION['email'] = $email;

        // Send OTP to the user's email
        $to = $email;
        $subject = "Your OTP Code";
        $message = "Your OTP code is $otp";
        $headers = "From: no-reply@sahayog.com";

        if (mail($to, $subject, $message, $headers)) {
            header("Location: verify-otp.php");
            exit();
        } else {
            echo "Failed to send OTP. Please try again.";
        }
    } else {
        echo "Email address not found.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #1e1e1e;
            color: #ffffff;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #333333;
            border-radius: 8px;
            box-shadow: 0px 0px 20px rgba(255, 255, 255, 0.1);
            padding: 40px;
            max-width: 400px;
            width: 90%;
            text-align: center;
        }

        h2 {
            color: #ffffff;
            margin-bottom: 30px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #ffffff;
            font-weight: bold;
            text-align: left;
        }

        input[type="text"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #555555;
            border-radius: 5px;
            box-sizing: border-box;
            margin-bottom: 20px;
            font-size: 16px;
            background-color: #333333;
            color: #ffffff;
            transition: border-color 0.3s ease, background-color 0.3s ease, color 0.3s ease;
        }

        input[type="text"]:focus {
            outline: none;
            border-color: #007bff;
        }

        input[type="submit"] {
            width: 100%;
            background-color: #6ac786;
            color: black;
            border: none;
            padding: 14px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color:black;
            color:white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Forget Password</h2>
        <form method="post" action="">
            <label for="email"><i class="fas fa-envelope"></i> Enter your email address:</label>
            <input type="text" id="email" name="email" placeholder="Email address" required>
          
            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>
