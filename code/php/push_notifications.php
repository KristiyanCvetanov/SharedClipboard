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
$count = $_POST['count'];

// send
$query = "INSERT INTO NOTIFICATIONS (USER_ID, CLIPBOARD_ID, COUNT) VALUES (" . $user_id . ", " . $clipboard_id . ", ". $count . ")";

mysqli_query($conn, $query);
mysqli_close($conn);
?>