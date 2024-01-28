

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Borrowed Books</title>
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
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
                <a class="nav-link dropdown-toggle" data-toggle="dropdown">Display Borrowed Books</a>
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
        <h2>Display Borrowed Books</h2><br>
        <form method="get" action="">
            Member ID: <input type="text" name="member_id">
            <input type="submit" value="Search">
        </form>
        <br>
        <?php
        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["member_id"])) {

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
            $memberID = $_GET["member_id"];

            // Validate data (you may want to implement additional validation)
            // Execute SQL query to fetch Borrow Book records for the given Member ID
            $sql = "SELECT book.book_id, member.first_name, book.book_name, bookborrower.borrow_status, bookborrower.borrower_date_modified
                                    FROM bookborrower
                                    INNER JOIN book ON bookborrower.book_id = book.book_id
                                    INNER JOIN member ON bookborrower.member_id = member.member_id
                                    WHERE bookborrower.member_id = '$memberID'";

            $result = $conn->query($sql);

            if ($result === false) {
                die("Error executing the query: " . $conn->error);
            }

            if ($result->num_rows > 0) {
                // Display member records in a table format
                echo "<table border='1'>";
                echo "<tr><th>Book ID</th><th>Member Name</th><th>Book Name</th><th>Borrow Status</th><th>Date Modified</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["book_id"] . "</td>";
                    echo "<td>" . $row["first_name"] . "</td>";
                    echo "<td>" . $row["book_name"] . "</td>";
                    echo "<td>" . $row["borrow_status"] . "</td>";
                    echo "<td>" . $row["borrower_date_modified"] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "No member found with this ID.";
            }

            $conn->close();
        }
        ?>
    </div>

</body>
</html>
