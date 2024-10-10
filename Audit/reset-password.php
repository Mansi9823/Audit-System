
<?php
session_start();
include 'db_conn.php';

// Check if the user is logged in or has verified the OTP
if (!isset($_SESSION['email'])) {
    // If not, redirect to the login or OTP verification page
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = $_POST["password"];
    $email = $_SESSION['email'];

    // Hash the new password (if necessary)
    // This part is only necessary if the password isn't already hashed when received from the form
    // $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Update the password in the database
    // If the password is already hashed when received from the form, you don't need to rehash it
    // Otherwise, you should hash it here
    // If the password is already hashed in the form, replace $password with $hashed_password in the bind_param method
    $stmt = $conn->prepare("UPDATE admin_user SET password = ? WHERE email = ?");
    $stmt->bind_param("ss", $password, $email);

    if ($stmt->execute()) {
        // Password reset successfully
        // Clear the session
        session_unset();
        session_destroy();
        // Redirect to login page or success page
        header("Location: login.php");
        exit();
    } else {
        echo "Failed to reset password. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <style>
        /* Add your styles here */
    </style>
</head>
<body>
    <div class="container">
        <h2>Reset Password</h2>
        <form method="post" action="">
            <label for="password"><i class="fas fa-lock"></i> New Password:</label>
            <input type="password" id="password" name="password" required>
            <input type="submit" value="Reset Password">
        </form>
    </div>
</body>
</html>
