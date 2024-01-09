<!DOCTYPE html>
<html>
<head>
	<title>Member Registration</title>
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
	        	<a class="nav-link dropdown-toggle" data-toggle="dropdown">Member Details Registration  </a>
	        	<div class="dropdown-menu">
	        		<a class="dropdown-item" href="member_update.php">Member Details Update</a>
	        		<div class="dropdown-divider"></div>
	        		<a class="dropdown-item" href="member_delete.php">Member Details Delete</a>
	        		<div class="dropdown-divider"></div>
	        		<a class="dropdown-item" href="member_display.php">Member Details Display</a>
                    <div class="dropdown-divider"></div>
	        		<a class="dropdown-item" href="member_all_display.php">All Details Member</a>
	        	</div>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="logout.php">Logout</a>
		      </li>
		    </ul>
		</div>
	</nav><br>

    <h2>Library Member Registration</h2>
    <form action="" method="post">
        Member ID: <input type="text" name="member_id" pattern="M\d{3}" title="Please use format M001" required><br><br>
        First Name: <input type="text" name="first_name" required><br><br>
        Last Name: <input type="text" name="last_name" required><br><br>
        Birthday     : <input type="date" name="birthday" required><br><br>
        Email: <input type="email" name="email" required><br><br>
        <input type="submit" value="Register">
    </form>

		
</body>
</html>