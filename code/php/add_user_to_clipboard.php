<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "shared_clipboard";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $clipboard_id = $_POST['clipboard_id'];
    $user_id = $_POST['user_id'];

    // send
    $query = "INSERT INTO SUBSCRIPTIONS (USER_ID, CLIPBOARD_ID) VALUES (" . $user_id . ", " . $clipboard_id . ")";

    mysqli_query($conn, $query);
    mysqli_close($conn);
?>