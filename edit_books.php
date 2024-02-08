<?php
session_start();

$connection = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connection, "library_system");

$book_id = "";
$book_name = "";
$book_category = "";

// Edit Book
if (isset($_POST['edit_book'])) {
    $book_id = $_POST['edit_book_id'];
    $new_book_name = $_POST['new_book_name'];
    $new_book_category = $_POST['new_book_category'];

    $query = "UPDATE book SET book_name = '$new_book_name', category_id = '$new_book_category' WHERE book_id = '$book_id'";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        echo '<script type="text/javascript">alert("Book updated successfully."); window.location.href = "book_register.php";</script>';
    } else {
        echo '<script type="text/javascript">alert("Error updating book.");</script>';
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
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
        .navbar-custom {
            background-color: #000000; 
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
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
    <h2>Edit Book</h2>
    <form method="post" action="">
        <input type="text" name="edit_book_id" placeholder="Enter Book ID to Edit" required>
        <input type="text" name="new_book_name" placeholder="Enter New Book Name" required>

        <div class="form-group">
            <label for="new_book_category">New Book Category:</label>
            <select name="new_book_category" class="form-control" required>
                <?php
                    $category_query = "SELECT * FROM bookcategory";
                    $category_query_run = mysqli_query($connection, $category_query);

                    while ($category_row = mysqli_fetch_assoc($category_query_run)) {
                        echo '<option value="' . $category_row['category_id'] . '">' . $category_row['category_Name'] . '</option>';
                    }
                ?>
            </select>
        </div>

        <button type="submit" name="edit_book">Edit Book</button>
    </form>


</body>
</html>
