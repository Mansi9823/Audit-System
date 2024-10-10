<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sahayog Multistate Credit Co-operative Society Ltd.</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <style media="screen">
        /* Add any additional custom styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #1a1a1a; /* Dark background color */
            color: #fff; /* Light text color */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #333; /* Dark container background color */
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            padding: 40px;
            max-width: 400px;
            width: 100%;
        }

        .container h3 {
            text-align: center;
            margin-bottom: 30px;
            color: #fff; /* Light text color */
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            display: block;
            color: #fff; /* Light text color */
        }

        .input-group {
            position: relative;
        }

        .input-group input {
            width: 100%;
            padding: 12px 50px;
            border: 1px solid #555; /* Dark border color */
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
            background-color: #555; /* Dark input background color */
            color: #fff; /* Light text color */
        }

        .input-group i {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #ccc; /* Light icon color */
        }

        .form-group a {
            display: block;
            text-align: right;
            color: #ccc; /* Light link color */
            font-size: 14px;
            text-decoration: none;
        }

        .login_btn {
            width: 100%;
            background-color:#65eb659e; /* Primary button color */
            color: #fff;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .login_btn:hover {
            background-color: black; /* Darker button color on hover */
        }
    </style>
</head>

<body>
    <div class="container">
        <form action="verify.php" method="POST">
            <h3>KR Technology Engineer Login</h3>
            <div class="form-group">
                <label for="username">Username</label>
                <div class="input-group">
                    <i class="fas fa-envelope"></i>
                    <input type="text" placeholder="Enter Email*" class="form-control" id="username" name="username" />
                </div>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" placeholder="Enter Password*" class="form-control" id="password" name="password" />
                </div>
            </div>
            <div class="form-group">
                <a href="forget-password.php">Forget Password?</a>
            </div>
            <button type="submit" class="login_btn" name="submit">Log In</button>
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</body>

</html>
