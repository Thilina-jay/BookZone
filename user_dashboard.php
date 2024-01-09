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
            background-color: #f8f9fa;
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

        /*cards css on here */
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

    <center><p> Add cards here </p></center>
<!-- Use cards to add your features -->




<footer>
    Developed with ♡ by team wwwDot
</footer>

</body>
</html>
