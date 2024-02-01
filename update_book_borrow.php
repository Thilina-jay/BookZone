<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Connect to the database
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "library_system";
    
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve form data
    $borrowID = $_POST["borrow_id"];
    $bookID = $_POST["book_id"];
    $memberID = $_POST["member_id"];
    $borrowStatus = $_POST["borrow_status"];
    $modifiedDate = $_POST["borrower_date_modified"];

    // Validate data (you may want to implement additional validation)

    // Execute SQL query to update data in the database
    $sql = "UPDATE bookborrower SET borrow_id='$borrowID', book_id='$bookID', member_id='$memberID', borrow_status='$borrowStatus', borrower_date_modified='$modifiedDate' WHERE borrow_id='$borrowID'";

    if ($conn->query($sql) === TRUE) {
        echo "Book Borrow details updated successfully!";
    } else {
        echo "Error updating member details: " . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Borrowed Book</title>
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
    </style>
    
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="signup.php">
            <img src="book.png" alt="BookByte Logo">
        </a>
        <ul class="nav navbar-nav navbar-right">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown">Update Borrowed Book</a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="book_borrow.php">Borrow a Book</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="update_book_borrow.php">Update Borrowed Book</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="delete_book_borrow.php">Delete Borrowed Book</a>
                    <div class="dropdown-divider"></div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
            </li>
        </ul>
    </nav><br>

    <div class="container mt-5">
        <h2>Update Borrowed Book</h2>
        <form action="" method="post">
            Borrow ID: <input type="text" name="borrow_id" pattern="BR\d{3}" title="Please use format BR001" required><br><br>
            Book ID: <input type="text" name="book_id" pattern="B\d{3}" title="Please use format B001" required><br><br>
            Member ID: <input type="text" name="member_id" pattern="M\d{3}" title="Please use format M001" required><br><br>
            Status: 
            <select name="borrow_status" id="status" required>
                <option value="borrowed">Borrowed</option>
                <option value="available">Available</option>
            </select>
            Date: <input type="date" name="borrower_date_modified" required><br><br>
            <input type="submit" value="Update">
        </form>
    </div>
</body>
</html>
