<?php
    require 'login_and_signup/database_connect.php';

    $clipboard_id = $_POST['clipboard_id'];
    $user_id = $_POST['user_id'];

    // send
    $query = "INSERT INTO SUBSCRIPTIONS (USER_ID, CLIPBOARD_ID) VALUES (" . $user_id . ", " . $clipboard_id . ")";

    mysqli_query($conn, $query);
    mysqli_close($conn);
?>