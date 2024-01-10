<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Establish library_system connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "library_system";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve form data
    $member_id = $_POST['member_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $birthday = $_POST['birthday'];
    $email = $_POST['email'];

    // Perform validations if needed

    // Update user details in the library_system
    $sql = "UPDATE member SET first_name='$first_name', last_name='$last_name', birthday='$birthday', email='$email' WHERE member_id='$member_id'";

    if ($conn->query($sql) === TRUE) {
        echo "Member details updated successfully!";
    } else {
        echo "Error updating member details: " . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Member Update</title>
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
	        	<a class="nav-link dropdown-toggle" data-toggle="dropdown">Member Details Update</a>
	        	<div class="dropdown-menu">
	        		<a class="dropdown-item" href="member_registration.php">Member Details Registration</a>
	        		<div class="dropdown-divider"></div>
	        		<a class="dropdown-item" href="member_delete.php">Member Details Delete</a>
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


<h2>Update member Details</h2>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    Member ID: <input type="text" name="member_id"><br><br>
    First Name: <input type="text" name="first_name"><br><br>
    Last Name: <input type="text" name="last_name"><br><br>
    Birthday: <input type="date" name="birthday"><br><br>
    Email: <input type="email" name="email"><br><br>
    <input type="submit" value="Update"><br>
    
</form>

</body>
</html>
