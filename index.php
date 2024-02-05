<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookZone</title>
    <link rel="stylesheet" type="text/css" href="bootstrap-4.4.1/css/bootstrap.min.css">
    <script type="text/javascript" src="bootstrap-4.4.1/js/jquery_latest.js"></script>
    <script type="text/javascript" src="bootstrap-4.4.1/js/bootstrap.min.js"></script>
    <style type="text/css">
        body {
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            background-image: url('bk.png');
            background-size: cover;
            background-position: center;
            height: 100vh;
            overflow: hidden;
        }

        .navbar-brand img {
            width: auto;
            height: 30px;
        }

        #main_container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin-top: -50px; 
        }

        #main_content {
            padding: 40px;
            background-color: rgba(0, 0, 0, 0.9); 
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 20px;
            width: 80%;
            max-width: 600px;
            text-align: center;
            position: relative;
            color: #fff;
        }

        #login-form {
            max-width: 400px;
            margin: 0 auto;
        }

        #logo {
            width: 250px;
            margin-bottom: 20px;
        }

        #welcome-text {
            font-size: 18px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="signup.php">
                <img src="book.png" alt="Logo">
            </a>
        </div>
        <ul class="nav navbar-nav navbar-right">
            <li class="nav-item">
                <a class="nav-link" href="signup.php">User Register</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php">User Login</a>
            </li>
        </ul>
    </div>
</nav>
<br>

<div id="main_container">
    <div id="main_content">
        <img id="logo" src="book.png" alt="Logo">
        <p id="welcome-text">Welcome to BookZone Admin Panel.</p>
        <center><h3>User Login</h3></center>
        <form id="login-form" action="" method="post">
            <div class="form-group">
                <label for="username" class="sr-only">User Name:</label>
                <input type="text" name="username" class="form-control" placeholder="Username" required>
            </div>
            <div class="form-group">
                <label for="password" class="sr-only">Password:</label>
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <button type="submit" name="login" class="btn btn-primary btn-block">Login</button>
            <p class="mt-3 text-center"><a href="signup.php">Not registered yet?</a></p>
        </form>
        <?php
        session_start();

        if (isset($_POST['login'])) {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "library_system";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $username = $_POST['username'];
            $password = $_POST['password'];

            $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $_SESSION['username'] = $username;
                header("Location: user_dashboard.php");
                exit();
            } else {
                $error_message = "Invalid username or password";
                echo "<script>alert('$error_message');</script>";
            }

            $conn->close();
        }
        ?>
    </div>
</div>

</body>
</html>