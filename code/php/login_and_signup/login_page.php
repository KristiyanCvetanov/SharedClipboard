<?php
session_start();
?>

<!DOCTYPE html>
<html lang="bg">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Welcome to the Shared Clipboard</title>
    <link href="../../styles/login-register.css" rel="stylesheet"></link>
</head>
<body>
<div>
    <form class="signup-form" action="login_process.php" method="post" enctype="multipart/form-data">
        <h2 class="login-header">Login</h2>
        <div class="form-group">
            <label for="email"><b>Email</b></label>
            <input type="email" class="form-control" name="email" placeholder="Enter Email" required="required">
        </div>
        <div class="form-group">
            <label for="pass"><b>Password</b></label>
            <input type="password" class="form-control" name="pass" placeholder="Enter Password" required="required">
        </div>
        <div class="form-group">
            <button type="submit" name="save" class="btn btn-success btn-lg btn-block">Login</button>
        </div>
        <div class="text-center">Don't have an account? <a href="register.php">Register Here</a></div>
    </form>
</div>
</body>
</html>