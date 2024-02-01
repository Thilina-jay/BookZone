<?php
session_start();

$connection = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connection, "library_system");

$name = "";
$email = "";
$mobile = "";

if (isset($_SESSION['email'])) {
    $query = "SELECT * FROM user WHERE email = '$_SESSION[email]'";
    $query_run = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($query_run)) {
        $name = $row['first_name'];
        $email = $row['email'];
        $mobile = $row['mobile'];
    }
}

if (isset($_POST['add_fine'])) {
    $fine_id = $_POST['fine_id'];
    $member_id = $_POST['member_id'];
    $book_id = $_POST['book_id'];
    $fine_amount = $_POST['fine_amount'];
    $fine_date_modified = $_POST['fine_date_modified'];

    $insert_query = "INSERT INTO fine (fine_id, member_id, book_id, fine_amount, fine_date_modified) VALUES ('$fine_id', '$member_id', '$book_id', '$fine_amount', '$fine_date_modified')";
    
    $insert_query_run = mysqli_query($connection, $insert_query);

    if ($insert_query_run) {
        echo '<script type="text/javascript"> alert("Fine added successfully."); </script>';
    } else {
        echo '<script type="text/javascript"> alert("No Book_ID Found."); </script>';
    }
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
        <h4>Add a Fine</h4><br>
    </center>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <form action="" method="post">
                <div class="form-group">
                    <label for="name">Fine ID:</label>
                    <input type="text" class="form-control" name="fine_id" required pattern="^F\d{3}$">
                    <small id="useridHelp" class="form-text text-muted">Fine ID should be in the 'F<Fine_ID>' format (e.g., F001).</small>
                </div>
                <div class="form-group">
                    <label for="name">Member ID:</label>
                    <input type="text" class="form-control" name="member_id" required pattern="^M\d{3}$">
                    <small id="useridHelp" class="form-text text-muted">MemberID should be in the 'F<Member_ID>' format (e.g., M001).</small>
                </div>
                <div class="form-group">
                    <label for="name">Book ID:</label>
                    <input type="text" class="form-control" name="book_id" required pattern="^B\d{3}$">
                    <small id="useridHelp" class="form-text text-muted">Book ID should be in the 'F<Book_ID>' format (e.g., B001).</small>
                </div>
                <div class="form-group">
                     <label for="name">Fine Amount</label>
                      <input type="number" name="fine_amount" class="form-control" min="2" max="500" title="Please enter a number between 2 and 500" required>
                </div>

                <div class="form-group">
                    <label for="name">Fine Date Modified:</label>
                    <input type="text" class="form-control" name="fine_date_modified" readonly
                        value="<?php echo date('Y-m-d H:i:s'); ?>">
                </div>
                <button type="submit" name="add_fine" class="btn btn-primary">Add Fine</button>
            </form>
        </div>
        <div class="col-md-4"></div>
    </div>

</body>

</html>
