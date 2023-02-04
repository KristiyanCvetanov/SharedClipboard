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
$user_id = 5;
$count = $_POST['count'];

// send
$query = "INSERT INTO NOTIFICATIONS (USER_ID, CLIPBOARD_ID, COUNT) VALUES (" . $user_id . ", " . $clipboard_id . ", ". $count . ")";
mysqli_query($conn, $query);

$query = "SELECT EMAIL FROM `USERS` WHERE ID=$user_id";
$result = mysqli_query($conn, $query);

$email = mysqli_fetch_array($result)['EMAIL'];

echo "<script>
        console.log($email); 
      </script>";
$send_mail_result = mail($email, "You have new notification from clipboards", "No subject");
if( $send_mail_result) {
    echo "<script>
        console.log('successfully'); 
      </script>";
}else {
    echo "<script>
        console.log('not successfully'); 
      </script>";
}

mysqli_close($conn);
?>