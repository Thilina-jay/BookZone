<?php
session_start();

$connection = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connection, "library_system");

$book_id = "";
$book_name = "";
$book_category = "";

// Add Book
if (isset($_POST['add_book'])) {
    $book_id = $_POST['book_id'];
    $book_name = $_POST['book_name'];
    $book_category = $_POST['book_category'];

    // Validate book_id format
    if (!preg_match('/^B\d{3}$/', $book_id)) {
        echo '<script type="text/javascript">alert("Invalid book ID format. It should be B followed by three numbers.");</script>';
    } else {
        // Check if book_id already exists
        $check_query = "SELECT * FROM book WHERE book_id = '$book_id'";
        $check_result = mysqli_query($connection, $check_query);

        if (mysqli_num_rows($check_result) > 0) {
            echo '<script type="text/javascript">alert("Book with this ID already exists.");</script>';
        } else {
            $query = "INSERT INTO book (book_id, book_name, category_id) VALUES ('$book_id', '$book_name', '$book_category')";
            $query_run = mysqli_query($connection, $query);

            if ($query_run) {
                echo '<script type="text/javascript">alert("Book added successfully."); window.location.href = "book_register.php";</script>';
            } else {
                echo '<script type="text/javascript">alert("Error adding book.");</script>';
            }
        }
    }
}


// Delete Book
if (isset($_POST['delete_book'])) {
    $book_id = $_POST['delete_book_id'];

    $query = "DELETE FROM book WHERE book_id = '$book_id'";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        echo '<script type="text/javascript">alert("Book deleted successfully."); window.location.href = "book_register.php";</script>';
    } else {
        echo '<script type="text/javascript">alert("Error deleting book.");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library System</title>
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

    body {
    font-family: Arial, sans-serif;
    align-items: center;
}

form {
    max-width: 400px;
    margin: 20px auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    align-items: center;
}

label {
    display: block;
    margin-bottom: 8px;
    align-items: center;
}

input[type="text"],
select,
textarea {
    width: 250px;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    align-items: center;
}

button {
    background-color: #4CAF50;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    align-items: center;
}

button:hover {
    background-color: #45a049;
}

h2 { text-align: center;
        }
</style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="user_dashboard.php">
        <img src="book.png" alt="BookByte Logo">
    </a>
    <div class="navbar-text">
   
</div>
			 
			
		    <ul class="nav navbar-nav navbar-right">
		      <li class="nav-item dropdown">
	        	<a class="nav-link dropdown-toggle" data-toggle="dropdown">Book details</a>
	        	<div class="dropdown-menu">
	        		<a class="dropdown-item" href="book_register.php">Register Book</a>
	        		<div class="dropdown-divider"></div>
	        		<a class="dropdown-item" href="all_books.php">All Books</a>
	        		<div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="delete_book.php">Delete Books</a>
                    <div class="dropdown-divider"></div>

	        	</div>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="logout.php">Logout</a>
		      </li>
		    </ul>
		</div>
	</nav><br>


    <h2>Delete Book</h2>
    <form method="post" action="">
        <input type="text" name="delete_book_id" placeholder="Enter Book ID to Delete" required>
        <button type="submit" name="delete_book">Delete Book</button>
    </form>
</body>
</html>
