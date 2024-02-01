<?php
$connection = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connection, "demo");

// Make sure to sanitize input to prevent SQL injection
$categoryId = mysqli_real_escape_string($connection, $_GET['cid']);

$query = "DELETE FROM bookcategory WHERE category_id = '$categoryId'";
$query_run = mysqli_query($connection, $query);

if ($query_run) {
    echo '<script type="text/javascript">';
    echo 'alert("Category Deleted successfully...");';
    echo 'window.location.href = "manage_cat.php";';
    echo '</script>';
} else {
    echo '<script type="text/javascript">';
    echo 'alert("Error deleting category.");';
    echo 'window.location.href = "manage_cat.php";';
    echo '</script>';
}
?>
