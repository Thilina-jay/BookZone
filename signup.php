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
            padding: 50px;
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

        .form-group {
            text-align: left;
        }

        label {
            color: #fff;
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
    </nav><br>
    <div id="main_container">
        <div id="main_content">
            <center>
                <h3>User Registration Form</h3>
            </center>
            <form action="register.php" method="post">

                <div class="form-group">
                    <label for="name">User Id:</label>
                    <input type="text" name="user_id" class="form-control" required pattern="^U\d{3}$">
                    <small id="useridHelp" class="form-text text-muted">User ID should be in the 'U<BOOK_ID>' format (e.g., U001).</small>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="name">First name:</label>
                    <input type="text" name="first_name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="name">Last name:</label>
                    <input type="text" name="last_name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="name">User name:</label>
                    <input type="text" name="username" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" class="form-control" required minlength="8">
                    <br> </br>

                    <button type="submit" class="btn btn-primary btn-block">Register</button>
            </form>
        </div>
    </div>

</body>

</html>
