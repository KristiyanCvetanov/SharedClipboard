<?php
    require 'login_and_signup/database_connect.php'

    $name = $_FILES['file']['name'];
    $new_path = $_POST['new_path'];
    
    if (file_exists($new_path)) {
        // handle error
    }
    
    // create the file in the new path
    if (!move_uploaded_file($_FILES['file']['tmp_name'], $new_path)) {
        echo "Failure";
        exit();
    }
    
    // $servername = "localhost";
    // $username = "root";
    // $password = "";
    // $dbname = "shared_clipboard";
    
    // // Create connection
    // $conn = new mysqli($servername, $username, $password, $dbname);
    
    // // Check connection
    // if ($conn->connect_error) {
    //     die("Connection failed: " . $conn->connect_error);
    // }
    
    $type = "resource_" . $_POST['type'];
    $clipboard_id = $_POST['clipboard_id'];
    $description = $_POST['description'];

    // send
    $query = "INSERT INTO " . $type . " (CLIPBOARD_ID, DESCRIPTION, CONTENT) VALUES (" . $clipboard_id . ", \"" . $description . "\", \"" . $new_path . "\")";
    mysqli_query($conn, $query);
    
    mysqli_close($conn);
?>