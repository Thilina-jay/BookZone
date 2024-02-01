
<!DOCTYPE html>
<html>
<head>
	<title>Library Member Records</title>
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

    .table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
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
	        	<a class="nav-link dropdown-toggle" data-toggle="dropdown">All Member Details</a>
	        	<div class="dropdown-menu">
	        		<a class="dropdown-item" href="member_registration.php">Member Details Registration</a>
	        		<div class="dropdown-divider"></div>
	        		<a class="dropdown-item" href="member_update.php">Member Details Update</a>
	        		<div class="dropdown-divider"></div>
	        		<a class="dropdown-item" href="member_delete.php">Member Details Delete</a>
                    <div class="dropdown-divider"></div>
	        		<a class="dropdown-item" href="member_display.php">Member Details Display</a>
	        	</div>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="logout.php">Logout</a>
		      </li>
		    </ul>
		</div>
	</nav><br>


    <h2>Library Member Records</h2>
    <table>
        <tr>
            <th>Member ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Birthday</th>
            <th>Email</th>
            
        </tr>
        
        <?php
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

        // Fetch member records from the DB
        $sql = "SELECT member_id, first_name, last_name, birthday, email FROM member";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["member_id"] . "</td>";
                echo "<td>" . $row["first_name"] . "</td>";
                echo "<td>" . $row["last_name"] . "</td>";
                echo "<td>" . $row["birthday"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                
                echo "</tr>";
            }
        } else {
            echo "0 results";
        }

        $conn->close();
        ?>
    </table>

    </body>
</html>

