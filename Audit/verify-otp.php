<?php
include 'db_conn.php';
session_start();

// Ensure session variables are set
if (!isset($_SESSION['otp']) || !isset($_SESSION['email'])) {
    echo "Session variables are not set. Please restart the process.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $otp = trim($_POST["otp"]);
    $password = trim($_POST["password"]);
    $email = $_POST['email'];

    // Debug: Log OTP and session data
    error_log("Entered OTP: '" . $otp . "'");
    error_log("Session OTP: '" . $_SESSION['otp'] . "'");
    error_log("Session Email: '" . $email . "'");

    // Basic input validation
    if (empty($otp) || empty($password)) {
        echo "OTP and Password are required.";
        exit;
    }

    // Ensure OTPs are compared as strings
    if ((string)$otp !== (string)$_SESSION['otp']) {
        echo "Invalid OTP. Please try again.";
        exit;
    }

    // Check password strength (example: minimum 8 characters)
    if (strlen($password) < 8) {
        echo "Password must be at least 8 characters long.";
        exit;
    }

    // Update the user's password in the database
    $stmt = $conn->prepare("UPDATE admin_user SET password = ? WHERE email = ?");
    if ($stmt) {
        $stmt->bind_param("ss", $password, $email);
        if ($stmt->execute()) {
            // Clear OTP and email from session
            unset($_SESSION['otp']);
            unset($_SESSION['email']);
            // Redirect to password_success.php
            header("Location: password_success.php");
            exit;
        } else {
            echo "Failed to reset password. Please try again.";
        }
        $stmt->close();
    } else {
        echo "Failed to prepare the SQL statement.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: Black;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #2d2a2a;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            padding: 40px;
            max-width: 400px;
            width: 100%;
        }

        h2 {
            text-align: center;
            color:white;
            margin-bottom: 30px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: white;
            font-weight: bold;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 12px;
            border: px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            background-color: #060505d4;
            color:white;
        }

        input[type="submit"] {
            width: 100%;
            background-color: #3aa34b;
            color: #fff;
            border: none;
            padding: 12px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
             margin-top: 20px;
        }

        input[type="submit"]:hover {
            background-color: black;
            color :white;
           
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Verify OTP</h2>
        <form method="post" action="verify-otp.php">
            <label for="otp"><i class="fas fa-key"></i> Enter OTP:</label>
            <input type="text" id="otp" name="otp" required>
            <label for="password"><i class="fas fa-lock"></i> Enter New Password:</label>
            <input type="password" id="password" name="password" required>
             <input type="hidden" name="email" value="<?= isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>" />
            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html> 