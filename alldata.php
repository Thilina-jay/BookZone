<?php
session_start();

$connection = mysqli_connect("localhost", "root", "");
if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

$db = mysqli_select_db($connection, "library_system");
if (!$db) {
    die("Database selection failed: " . mysqli_error($connection));
}

$query = "SELECT * FROM user";
$query_run = mysqli_query($connection, $query);

if (!$query_run) {
    die("Query failed: " . mysqli_error($connection));
}

mysqli_close($connection);
?>

<!DOCTYPE html>
<html>

<head>
    <title>User Records</title>
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
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
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
                    <a class="dropdown-item" href="alldata.php">User Records</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
            </li>
        </ul>
    </nav><br>
    <center>
        <h4> User Records</h4><br>
    </center>
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Email Address</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($query_run)) {
                    echo "<tr>";
                    echo "<td>" . $row['user_id'] . "</td>";
                    echo "<td>" . $row['first_name'] . "</td>";
                    echo "<td>" . $row['last_name'] . "</td>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "<td>" . $row['password'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>";

                    
                    if ($_SESSION['username'] != $row['username']) {
                        echo '<form method="post" action="delete_user.php" onsubmit="return confirm(\'Are you sure you want to delete this user?\')">';
                        echo '<input type="hidden" name="user_id" value="' . $row['user_id'] . '">';
                        echo '<button type="submit" name="delete_user" class="btn btn-danger">Delete</button>';
                        echo '</form>';
                    } else {
                        echo 'Current User Cannot Delete';
                    }

                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>
