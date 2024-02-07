<?php
session_start();

$connection = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connection, "library_system");

$book_id = "";
$book_name = "";
$book_category = "";

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
?>

<!DOCTYPE html>
<html>
<head>
	<title>Book Register</title>
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
	        	<a class="nav-link dropdown-toggle" data-toggle="dropdown">Book details </a>
	        	<div class="dropdown-menu">
	        		<a class="dropdown-item" href="edit_books.php">Edit Books</a>
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

    <!--navigation bar end-->

<h1 style="text-align: center; margin-bottom: 20px; font-family: 'Roboto', sans-serif;">Book Registration</h1>

<div class ="row"> 
    <div class="col-md-4" ></div >
    <div class="col-md-4" > 
        <form action="" method="post">

            <div class="form-group" >
                <label for="book_id">Book ID:</label>
                <input type="text" name="book_id" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="book_name">Book Name:</label>
                <input type="text" name="book_name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="book_category">Book Category:</label>
                <select name="book_category" class="form-control" required>
                    <?php
                        $category_query = "SELECT * FROM bookcategory";
                        $category_query_run = mysqli_query($connection, $category_query);

                        while ($category_row = mysqli_fetch_assoc($category_query_run)) {
                            echo '<option value="' . $category_row['category_id'] . '">' . $category_row['category_Name'] . '</option>';
                        }
                    ?>
                </select>
            </div>

            <button type="submit" name="add_book" class="btn btn-primary" style="width: 100%;">Add Book</button>

        </form>
    </div>
    <div class="col-md-4" > </div>

                    </div>

</body>



</html>