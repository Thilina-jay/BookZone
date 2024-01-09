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

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_user'])) {
    $user_id_to_delete = $_POST['user_id'];

    
    if ($_SESSION['username'] != $_POST['username']) {
        $delete_query = "DELETE FROM user WHERE user_id = '$user_id_to_delete'";
        $delete_result = mysqli_query($connection, $delete_query);

        if ($delete_result) {
            echo "User deleted successfully";
            header("Location: alldata.php");  
            exit();
        } else {
            echo "Error deleting user: " . mysqli_error($connection);
        }
    } else {
        echo "Cannot delete the currently logged-in user";
    }
}

mysqli_close($connection);
?>
