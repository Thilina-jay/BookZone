<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

function get_user_issue_book_count() {
    $connection = mysqli_connect("localhost", "root", "", "library_system");
    $user_issue_book_count = 0;

    if ($connection) {
        $query = "SELECT COUNT(*) AS user_issue_book_count FROM issued_books WHERE student_id = $_SESSION[id]";
        $query_run = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($query_run)) {
            $user_issue_book_count = $row['user_issue_book_count'];
        }

        mysqli_close($connection);
    }

    return $user_issue_book_count;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin dashboard</title>
    <meta charset="utf-8" name="viewport" content="width=device-width,intial-scale=1">
    <link rel="stylesheet" type="text/css" href="bootstrap-4.4.1/css/bootstrap.min.css">
    <script type="text/javascript" src="bootstrap-4.4.1/js/juqery_latest.js"></script>
    <script type="text/javascript" src="bootstrap-4.4.1/js/bootstrap.min.js"></script>
    <style type="text/css">
        body {
            background: url('bk1.png') no-repeat center center fixed;
            background-size: cover;
        }

        footer {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        .navbar {
            background-color: #343a40;
        }

        .navbar-brand img {
            height: 30px;
        }

        #main_content {
            padding: 50px;
            background-color: whitesmoke;
        }

        .container {
            margin-top: 30px;
        }

        .box {
            cursor: pointer;
            padding: 20px;
            height: 250px;
            border-radius: 10px;
            text-align: center;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            border: 1px solid #e0e0e0; /* White hairline border */
        }

        .box:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); /* Added drop shadow on hover */
        }

        .box h4 {
            font-size: 1.5rem;
            margin-bottom: 15px;
            color: white;
        }

        .box button {
            background-color: #005D89;
            color: #fff;
            border: none;
            padding: 8px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            width: 100%;
            margin-bottom: 15px;
        }

        .box .btn-secondary, .box .btn-outline-secondary {
            width: 100%;
            margin-bottom: 5px;
            color: #ffffff;
        }

        .box .btn-outline-secondary {
            background-color: transparent;
            border: 1px solid #007bff;
        }

        .box .btn-group {
            width: 100%;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }

        .box button:hover {
            background-color: #074C6F;
        }

        .box {
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            margin-bottom: 20px;
            position: relative;
        }

        .box button {
            width: 80%;
            position: absolute;
            bottom: 0;
            margin-top: auto;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="signup.php">
                <img src="book.png" alt="BookByte Logo">
            </a>
        </div>
        <font style="color: white"><span><strong>Welcome: <?php echo $_SESSION['username'];?></strong></span></font>
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
    <div class="row">
        <?php
        $cards = array(
            array("Books registration", "book_register.php", "1.jpg", "book_register.php", "secondary2.php", "View", "Manage"),
            array("Category registration", "add_cat.php", "2.jpg", "secondary1.php", "secondary2.php", "View", "Manage"),
            array("Member registration", "member_registration.php", "3.jpg", "secondary1.php", "secondary2.php", "View", "Manage"),
            array("Borrow details", "book_borrow.php", "4.jpg", "secondary1.php", "secondary2.php", "View", "Manage"),
            array("Assign Fine", "assign_fine.php", "5.jpg", "assign_fine.php", "secondary2.php", "View", "Manage"),
        );

        for ($i = 0; $i < 3; $i++) {
            echo '<div class="col-md-4">';
            echo '<div class="box centered-box" style="background-image: url(' . $cards[$i][2] . '); background-size: cover; background-position: center;">';


            echo '<button class="btn btn-primary" onclick="window.location.href=\'' . $cards[$i][1] . '\'">Go to ' . $cards[$i][0] . '</button>';
            echo '</div>';
            echo '</div>';
        }
        ?>
    </div>

    <div class="row justify-content-center">
        <?php
        for ($i = 3; $i < 5; $i++) {
            echo '<div class="col-md-4">';
            echo '<div class="box centered-box" style="background-image: url(' . $cards[$i][2] . '); background-size: cover; background-position: center;">';


            echo '<button class="btn btn-primary" onclick="window.location.href=\'' . $cards[$i][1] . '\'">Go to ' . $cards[$i][0] . '</button>';
            echo '</div>';
            echo '</div>';
        }
        ?>
    </div>
</div>

<footer>
    Developed with ♡ by team wwwDot
</footer>

</body>
</html>
