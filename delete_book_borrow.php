<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Borrowed Book</title>
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
            margin-right: 0;
            color: white;
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
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this borrowed book?");
        }
    </script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <a class="navbar-brand" href="user_dashboard.php">
            <img src="book.png" alt="BookByte Logo">
        </a>
        <ul class="nav navbar-nav navbar-right">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown">Delete Borrowed Book</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="book_borrow.php">Borrow a Book</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="update_book_borrow.php">Update Borrowed Book</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="delete_book_borrow.php">Delete Borrowed Book</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="view_all_borrow.php">View all</a>
                    <div class="dropdown-divider"></div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
            </li>
        </ul>
    </nav><br>

    <div class="container mt-5">
        <h2>Delete Borrowed Book</h2>
        <form action="" method="post">
            Borrow ID: <input type="text" name="borrow_id" pattern="BR\d{3}" title="Please use format BR001" required><br><br>
            <input type="submit" value="Delete" onclick="return confirmDelete();">
        </form>
    </div>
</body>
</html>

<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "library_system";
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $conn = new mysqli($servername, $username, $password, $dbname);

         // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    // Retrieve form data
    $borrowID = $_POST["borrow_id"];
    // Execute SQL query to delete data from the database
    $sql = "DELETE FROM bookborrower WHERE borrow_id = '$borrowID'";
    
    if ($conn->query($sql) === TRUE) {
        if ($conn->affected_rows > 0) {
            echo "Borrowed Book deleted successfully!";
        } else {
            echo "No matching borrowed book found to delete.";
        }
    } else {
        echo "Error deleting borrowed book: " . $conn->error;
    }

    $conn->close();
    } else {
        echo "";
    }

?>
