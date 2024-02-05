<?php
session_start();

$connection = mysqli_connect("localhost", "root", "", "library_system");

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


function get_category_name_from_database() {
    global $connection;

    if (isset($_GET['cid'])) {
        $cat_id = $_GET['cid'];
        $query = "SELECT category_Name FROM bookcategory WHERE category_id = '$cat_id'";
        $query_run = mysqli_query($connection, $query);

        if ($query_run) {
            $row = mysqli_fetch_assoc($query_run);
            return $row['category_Name'];
        }
    }

    return ''; 
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Add New Category</title>
    <meta charset="utf-8" name="viewport" content="width=device-width,intial-scale=1">
    <link rel="stylesheet" type="text/css" href="bootstrap-4.4.1/css/bootstrap.min.css">
    <script type="text/javascript" src="bootstrap-4.4.1/js/juqery_latest.js"></script>
    <script type="text/javascript" src="bootstrap-4.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        function alertMsg() {
            alert("Category added successfully...");
            window.location.href = "add_cat.php";
        }
    </script>
    <style type ="text/css">
    .navbar-brand img {
        width: auto; 
        height: 30px; 
    }
    #main_content{
		padding: 50px;
		background-color: whitesmoke;
	}
	#side_bar{
		background-color: whitesmoke;
		padding: 50px;
		width: 200px;
		height: 750px;
	}
	#sidebar-image {
    max-width: 80%;
    height: auto;
    display: block;
    margin: 20px auto; 
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
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown">Category </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="add_cat.php">Add Category</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="edit_cat.php">Edit Category</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="manage_cat.php">Manage category</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="Regcat.php">All Category</a>
                        
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav><br>
    <center>
        <h4>Edit Book Category</h4><br>
    </center>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <form action="" method="post">
                <div class="form-group">
                    <label for="cat_id">Category ID:</label>
                    <input type="text" class="form-control" name="cat_id" pattern="^C\d{3}$" value="<?php echo isset($_POST['cat_id']) ? $_POST['cat_id'] : (isset($_GET['cid']) ? $_GET['cid'] : ''); ?>" required>
                    <small>Format: C001</small>
                </div>
                <div class="form-group">
                    <label for="cat_name">Category Name:</label>
                   
                    <input type="text" class="form-control" name="cat_name" value="<?php echo isset($_GET['cname']) ? $_GET['cname'] : get_category_name_from_database(); ?>" required>
                </div>
                <div class="form-group">
                    <label for="date_modified">Date Modified:</label>
                  
                    <input type="text" class="form-control" name="date_modified" value="<?php echo date('Y-m-d'); ?>" readonly>
                </div>
                <button type="submit" name="update_cat" class="btn btn-primary">Update Category</button>
            </form>

            <?php
           
            if (isset($_POST['update_cat'])) {
                $cat_id = $_POST['cat_id'];
                $cat_name = $_POST['cat_name'];
                $date_modified = $_POST['date_modified'];

            
                if (!preg_match("/^C\d{3}$/", $cat_id)) {
                    echo "Invalid Category ID format!";
                   
                    exit();
                }

                $query = "UPDATE bookcategory SET category_Name = ?, date_modified = ? WHERE category_id = ?";
                $stmt = mysqli_prepare($connection, $query);

                if ($stmt === false) {
                    die(mysqli_error($connection)); 
                }

                mysqli_stmt_bind_param($stmt, 'sss', $cat_name, $date_modified, $cat_id);
                $query_run = mysqli_stmt_execute($stmt);

                if ($query_run) {
                    echo '<script>alertMsg();</script>';
                } else {
                    echo '<script>alert("Error updating category: ' . mysqli_error($connection) . '");</script>';
                }
            }
            ?>
        </div>
        <div class="col-md-4"></div>
    </div>
</body>

</html>
