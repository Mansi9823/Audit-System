<?php
include "session.php";
date_default_timezone_set("Asia/Kolkata");
$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$login_Cheker = "SELECT * FROM `admin_user` WHERE `email` = '$username' AND `password` = '$password'";
$result_login = mysqli_query($conn, $login_Cheker);
$row = mysqli_fetch_assoc($result_login);

if (mysqli_num_rows($result_login) > 0) {
    $_SESSION['admin_id'] = $row["email"];
    $_SESSION['user_id'] = $row["slno"];

    header("Location:dashboard.php");
  
} else {
  mysqli_close($conn);
  echo "<script type='text/javascript'>alert('Wrong User ID/Password!');
  window.location='login.php';
  </script>";
  ob_end_flush();
}
?>


