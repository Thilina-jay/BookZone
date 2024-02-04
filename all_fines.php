<?php
session_start();

$connection = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connection, "library_system");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Fine Details</title>
    <meta charset="utf-8" name="viewport" content="width=device-width,intial-scale=1">
	<link rel="stylesheet" type="text/css" href="bootstrap-4.4.1/css/bootstrap.min.css">
  	<script type="text/javascript" src="bootstrap-4.4.1/js/juqery_latest.js"></script>
  	<script type="text/javascript" src="bootstrap-4.4.1/js/bootstrap.min.js"></script>
      <style>
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

        h2 {
            text-align: center;
        }
 
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            
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
<div class="container-fluid">
			<div class="navbar-header">
            <a class="navbar-brand" href="user_dashboard.php">
                <img src="book.png" alt="BookByte Logo">
            </a>
			</div>
			
		    <ul class="nav navbar-nav navbar-right">
		      <li class="nav-item dropdown">
	        	<a class="nav-link dropdown-toggle" data-toggle="dropdown">Fine Details </a>
	        	<div class="dropdown-menu">
                <a class="dropdown-item" href="assign_fine.php">Assign Fine</a>
	        		<div class="dropdown-divider"></div>
	        		<a class="dropdown-item" href="update_fine.php">Edit Fine</a>
	        		<div class="dropdown-divider"></div>
	        		<a class="dropdown-item" href="delete_fine.php">Delete Fine</a>
	        		<div class="dropdown-divider"></div>
	        		
	        		<a class="dropdown-item" href="all_fines.php">All Fines</a>
	        	</div>
				
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="logout.php">Logout</a>
		      </li>
		    </ul>
		</div>
	</nav><br>

    <center>
        <h4>All Fine Details</h4><br>
    </center>

    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>Fine ID</th>
                    <th>Member ID</th>
                    <th>Book ID</th>
                    <th>Fine Amount</th>
                    <th>Fine Date Modified</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM fine";
                $query_run = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($query_run)) {
                    echo "<tr>";
                    echo "<td>{$row['fine_id']}</td>";
                    echo "<td>{$row['member_id']}</td>";
                    echo "<td>{$row['book_id']}</td>";
                    echo "<td>{$row['fine_amount']}</td>";
                    echo "<td>{$row['fine_date_modified']}</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</body>

</html>
