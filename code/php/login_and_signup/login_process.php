<?php
session_start();
if (isset($_POST['save'])) {
    extract($_POST);
    include 'database_connect.php';

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = mysqli_query ($conn,"SELECT * FROM USERS where EMAIL='$email' and PASSWORD='$pass'");
    $row  = mysqli_fetch_array($sql);
    if (is_array($row)) {
        header("Location: ../home-user.php");
    }
    else {
        echo "Invalid Email ID/Password";
    }
}
?>