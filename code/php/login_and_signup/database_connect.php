<?php
$url = 'localhost';
$username = 'root';
$password = '';
$conn = mysqli_connect ($url,$username,$password,"shared_clipboard");
if (!$conn) {
    die('Could not Connect My Sql:' .mysqli_error());
}
