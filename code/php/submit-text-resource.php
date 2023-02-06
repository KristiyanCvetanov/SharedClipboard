<?php
    require 'login_and_signup/database_connect.php'
    
    $input = $_POST["input"];
    $type = "resource_" . $_POST["type"];
    $clipboard_id = $_POST['clipboard_id'];
    $description = $_POST['description'];
    
    // //connect to the database
    // $servername = "localhost";
    // $username = "root";
    // $password = "";
    // $dbname = "shared_clipboard";

    // // Create connection
    // $conn = new mysqli($servername, $username, $password, $dbname);
    
    // send
    $query = "INSERT INTO " . $type . " (CLIPBOARD_ID, DESCRIPTION, CONTENT) VALUES (" . $clipboard_id . ", \"" . $description . "\", \"" . $input . "\")";
    mysqli_query($conn, $query);
    
    mysqli_close($conn);
?>