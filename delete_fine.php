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

if (isset($_POST['delete'])) {
    $fine_id = $_POST['fine_id'];

    $delete_query = "DELETE FROM fine WHERE fine_id = '$fine_id'";

    $delete_query_run = mysqli_query($connection, $delete_query);

    if ($delete_query_run) {
        echo '<script type="text/javascript"> alert("Fine deleted successfully."); </script>';
    } else {
        echo '<script type="text/javascript"> alert("Error deleting fine."); </script>';
    }
}

mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Fine</title>
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
        }

        .box:hover {
            transform: scale(1.05);
        }

        .box h4 {
            font-size: 1.5rem;
            margin-bottom: 15px;
            color: white;
        }

        .box button {
            background-color: #007bff;
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
            background-color: #0056b3;
        }
        .navbar-custom {
            background-color: #000000; 
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
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
    <h4>Delete Fine</h4><br>
</center>
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <form action="delete_fine.php" method="post">
            <div class="form-group">
                <label for="name">Fine ID:</label>
                <input type="text" class="form-control" name="fine_id" required pattern="^F\d{3}$">
                <small id="useridHelp" class="form-text text-muted">Fine ID should be in the 'F<Fine_ID>' format (e.g., F001).</small>
            </div>

            <button type="submit" name="delete" class="btn btn-primary">Delete</button>
        </form>
    </div>
    <div class="col-md-4"></div>
</div>
</body>
</html>
