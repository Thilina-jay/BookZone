<?php
$connection = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connection, "library_system");


$user_id = $_POST['user_id'];

$query = "UPDATE user SET email = '$_POST[email]', first_name = '$_POST[first_name]', last_name = '$_POST[last_name]', username = '$_POST[username]' WHERE user_id = '$user_id'";
$query_run = mysqli_query($connection, $query);

if ($query_run) {
    echo '<script type="text/javascript">';
    echo 'alert("Updated successfully...Login Again");';
    echo 'window.location.href = "index.php";';
    echo '</script>';
} else {
    echo '<script type="text/javascript">';
    echo 'alert("Error updating record: ' . mysqli_error($connection) . '");';
    echo 'window.location.href = "edit_profile.php";';
    echo '</script>';
}

mysqli_close($connection);
?>
