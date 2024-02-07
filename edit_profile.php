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

$user_id = "";
$email = "";
$first_name = "";
$last_name = "";
$username = "";

$query = "SELECT * FROM user WHERE username = '{$_SESSION['username']}'";
$query_run = mysqli_query($connection, $query);

if (!$query_run) {
    die("Query failed: " . mysqli_error($connection));
}

while ($row = mysqli_fetch_assoc($query_run)) {
    $user_id = $row['user_id'];
    $email = $row['email'];
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    $username = $row['username'];
}

mysqli_close($connection);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Edit Profile</title>
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
        color: white; 
    }

    .navbar-nav {
        margin-left: auto;
    }

    .navbar-nav .nav-item {
        margin-right: 10px;
    }
</style>

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="user_dashboard.php">
        <img src="book.png" alt=" Logo">
    </a>
    <div class="navbar-text">
    <font style="color: white"><span><strong>Welcome: <?php echo $_SESSION['username'];?></strong></span></font>
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
		<center><h4>Edit Profile</h4><br></center>
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
			<form action="update.php" method="post">
    <div class="form-group">
    <label for="name">User ID:</label>
    <input type="text" name="user_id" class="form-control" value="<?php echo $user_id;?>" readonly> 
    <small id="useridHelp" class="form-text text-muted">User ID can't change</small>
    </div>
    <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" name="username" value="<?php echo $username;?>" class="form-control">
    </div>
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" name="email" class="form-control" value="<?php echo $email;?>">
    </div>
    <div class="form-group">
        <label for="mobile">First name:</label>
        <input type="text" name="first_name" value="<?php echo $first_name;?>" class="form-control">
    </div>
    <div class="form-group">
        <label for="email">Last name:</label>
        <input type="text" name="last_name" value="<?php echo $last_name;?>" class="form-control">
    </div>
   
    <button type="submit" name="update" class="btn btn-primary">Update</button>
</form>

			</div>
			<div class="col-md-4"></div>
		</div>
</body>
</html>
