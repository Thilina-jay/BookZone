<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $connection = mysqli_connect("localhost", "root", "");
    if (!$connection) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    $db = mysqli_select_db($connection, "library_system");
    if (!$db) {
        die("Database selection failed: " . mysqli_error($connection));
    }

    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_new_password = $_POST['confirm_new_password'];

    
    if ($new_password != $confirm_new_password) {
        echo '<script type="text/javascript">';
        echo 'alert("New password and confirm password do not match...");';
        echo 'window.location.href = "change_password.php";';
        echo '</script>';
        exit(); 
    }

    
    $query = "SELECT password FROM user WHERE username = '{$_SESSION['username']}'";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        $user_data = mysqli_fetch_assoc($query_run);
        if ($user_data) {
            
            echo "Entered Current Password: $current_password<br>";
            echo "Stored Password: {$user_data['password']}<br>";

            if ($current_password == $user_data['password']) {
                
                echo "Password Matched!<br>";

                
                $update_query = "UPDATE user SET password = '$new_password' WHERE username = '{$_SESSION['username']}'";
                $update_query_run = mysqli_query($connection, $update_query);

                if ($update_query_run) {
                    echo '<script type="text/javascript">';
                    echo 'alert("Password updated successfully.Login again");';
                    echo 'window.location.href = "index.php";';
                    echo '</script>';
                } else {
                    echo '<script type="text/javascript">';
                    echo 'alert("Error updating password: ' . mysqli_error($connection) . '");';
                    echo '</script>';
                }
            } else {
                
                echo "Password Mismatch!<br>";

                
                echo '<script type="text/javascript">';
                echo 'alert("Invalid current password...");';
                echo 'window.location.href = "user_dashboard.php";';
                echo '</script>';
            }
        } else {
            
            echo "User not found!<br>";

            
            echo '<script type="text/javascript">';
            echo 'alert("Invalid current password...");';
            echo 'window.location.href = "user_dashboard.php";';
            echo '</script>';
        }
    } else {
        
        echo "Query failed: " . mysqli_error($connection) . "<br>";

        echo '<script type="text/javascript">';
        echo 'alert("Error retrieving current password: ' . mysqli_error($connection) . '");';
        echo 'window.location.href = "user_dashboard.php";';
        echo '</script>';
    }

    mysqli_close($connection);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Change Password</title>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="bootstrap-4.4.1/css/bootstrap.min.css">
    <script type="text/javascript" src="bootstrap-4.4.1/js/juqery_latest.js"></script>
    <script type="text/javascript" src="bootstrap-4.4.1/js/bootstrap.min.js"></script>
    <style type="text/css">
        .navbar-brand img {
            width: auto;
            height: 30px;
        }

        .navbar-text {
            text-align: center;
            margin-left: auto;
            margin-right: auto;
            margin-right: 0;
            color: white;
        }

        .navbar-nav {
            margin-left: auto;
        }

        .navbar-nav .nav-item {
            margin-right: 10px;
        }
        .container {
            margin-top: 20px;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 15px;
        }
        .navbar-custom {
            background-color: #000000; 
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <a class="navbar-brand" href="user_dashboard.php">
            <img src="book.png" alt="Logo">
        </a>
        <div class="navbar-text">
            <font style="color: white"><span><strong>Welcome: <?php echo $_SESSION['username']; ?></strong></span></font>
        </div>
        <ul class="nav navbar-nav navbar-right">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown">My Profile </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="view_profile.php">View Profile</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="edit_profile.php">Edit Profile</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="change_password.php">Change Password</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="alldata.php">All data</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
            </li>
        </ul>
        </div>
    </nav><br>

    <div class="container">
    <center><h4>Change password</h4><br></center>
        <form action="" method="post">
            <div class="form-group">
                <label for="current_password">Current Password:</label>
                <input type="password" name="current_password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="new_password">New Password:</label>
                <input type="password" name="new_password" class="form-control" required minlength="8">
            </div>
            <div class="form-group">
                <label for="confirm_new_password">Confirm New Password:</label>
                <input type="password" name="confirm_new_password" class="form-control" required minlength="8">
            </div>
            <button type="submit" class="btn btn-primary">Change Password</button>
        </form>
    </div>
</body>

</html>
