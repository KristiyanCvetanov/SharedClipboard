<?php
    extract($_POST);
    include("database_connect.php");
    $sql = mysqli_query($conn,"SELECT * FROM USERS where EMAIL='$email'");
    if (mysqli_num_rows($sql) > 0)
    {
        echo "Email Id Already Exists";
        exit;
    }
    else if (isset($_POST['save']))
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $cpassword = $_POST['cpassword'];

        if ($password != $cpassword) {
            echo "Password doesn't match";
            exit;
        }

        $query = "INSERT INTO USERS (EMAIL, USERNAME, PASSWORD, IS_ADMIN) VALUES ('$email', '$username', '$password', false)";
        $sql = mysqli_query($conn, $query) or die("Could Not Perform the Query");
        header("Location: login_page.php?status=success");
    }