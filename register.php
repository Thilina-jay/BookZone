<?php
//Db connection for sign
    $connection = mysqli_connect("localhost", "root", "", "library_system");

 
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

  
    function isDuplicate($connection, $column, $value) {
        $query = "SELECT * FROM user WHERE $column = '$value'";
        $result = mysqli_query($connection, $query);

        return mysqli_num_rows($result) > 0;
    }


    $email = $_POST['email'];
    $username = $_POST['username'];

    if (isDuplicate($connection, 'email', $email)) {
        echo '<script>alert("Email already used. Please choose a different email."); window.location.href = "signup.php";</script>';
    } elseif (isDuplicate($connection, 'username', $username)) {
        echo '<script>alert("Username already used. Please choose a different username."); window.location.href = "signup.php";</script>';
    } else {
   
        $query = "INSERT INTO user (user_id, email, first_name, last_name, username, password) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($connection, $query);


        mysqli_stmt_bind_param($stmt, "ssssss", $_POST['user_id'], $email, $_POST['first_name'], $_POST['last_name'], $username, $_POST['password']);

     
        $query_run = mysqli_stmt_execute($stmt);

        if ($query_run) {
            echo '<script>alert("Registration successful. You may now login."); window.location.href = "index.php";</script>';
        } else {
            echo '<script>alert("Error in registration: ' . mysqli_error($connection) . '"); window.location.href = "signup.php";</script>';
        }
    }

    mysqli_close($connection);
?>