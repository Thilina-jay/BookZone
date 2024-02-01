
<!DOCTYPE html>
<html>
<head>
	<title>Search Library Member</title>
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
 </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="user_dashboard.php">
        <img src="book.png" alt="BookByte Logo">
    </a>
    
			 
			
<ul class="nav navbar-nav navbar-right">
		      <li class="nav-item dropdown">
	        	<a class="nav-link dropdown-toggle" data-toggle="dropdown">Member Details Display</a>
	        	<div class="dropdown-menu">
	        		<a class="dropdown-item" href="member_registration.php">Member Details Registration</a>
	        		<div class="dropdown-divider"></div>
	        		<a class="dropdown-item" href="member_update.php">Member Details Update</a>
	        		<div class="dropdown-divider"></div>
	        		<a class="dropdown-item" href="member_delete.php">Member Details Delete</a>
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


    <h2>Search Library Member by ID</h2><br>
    <form method="get" action="">
        Member ID: <input type="text" name="member_id">
        <input type="submit" value="Search">
    </form>
    <br>

    <?php
    if (isset($_GET['member_id'])) {
        // Establish DB(library_system) connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "library_system";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $member_id = $_GET['member_id'];

        // Fetch member records from the DB for the specified Member ID
        $sql = "SELECT member_id, first_name, last_name, birthday, email FROM member WHERE member_id='$member_id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Display member records in a table format
            echo "<table border='1'>";
            echo "<tr><th>Member ID</th><th>First Name</th><th>Last Name</th><th>Birthday</th><th>Email</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["member_id"] . "</td>";
                echo "<td>" . $row["first_name"] . "</td>";
                echo "<td>" . $row["last_name"] . "</td>";
                echo "<td>" . $row["birthday"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No member found with this ID.";
        }

        $conn->close();
    }
    ?>
		
</body>
</html>
