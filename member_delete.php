
<!DOCTYPE html>
<html>
<head>
	<title>Delete Member</title>
	<meta charset="utf-8" name="viewport" content="width=device-width,intial-scale=1">
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
        color: white; /* Set the color here */
    }

    .navbar-nav {
        margin-left: auto;
    }

    .navbar-nav .nav-item {
        margin-right: 10px;
    }
</style>
 </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="user_dashboard.php">
        <img src="book.png" alt="BookByte Logo">
    </a>
    
			 
			
<ul class="nav navbar-nav navbar-right">
		      <li class="nav-item dropdown">
	        	<a class="nav-link dropdown-toggle" data-toggle="dropdown">Member Details Delete</a>
	        	<div class="dropdown-menu">
	        		<a class="dropdown-item" href="member_registration.php">Member Details Registration</a>
	        		<div class="dropdown-divider"></div>
	        		<a class="dropdown-item" href="member_update.php">Member Details Update</a>
	        		<div class="dropdown-divider"></div>
	        		<a class="dropdown-item" href="member_display.php">Member Details Display</a>
                    <div class="dropdown-divider"></div>
	        		<a class="dropdown-item" href="member_all_display.php">All Member Details</a>
	        	</div>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="logout.php">Logout</a>
		      </li>
		    </ul>
		</div>
	</nav><br>

    <h2>Delete Member</h2><br>
    <form method="post" action="">
        Member ID: <input type="text" name="member_id"><br><br><br>
        <input type="submit" value="Delete">
    </form>




		
</body>
</html>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "library_system";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['member_id'])) {
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $member_id = $_POST['member_id'];
        $sql = "DELETE FROM member WHERE member_id='$member_id'";

        if ($conn->query($sql) === TRUE) {
            if ($conn->affected_rows > 0) {
                echo "Member deleted successfully!";
            } else {
                echo "No matching member found to delete.";
            }
        } else {
            echo "Error deleting member: " . $conn->error;
        }

        $conn->close();
    } else {
        echo "Member ID is not set!";
    }
}
?>