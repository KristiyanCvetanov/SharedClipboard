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
    <form class="signup-form" action="register_helper.php" method="post" enctype="multipart/form-data">
		<h2 class="register-header">Register</h2>
        <div class="form-group">
			<div class="row">
                <label for="username"><b>Username</b></label>
				<div class="col"><input type="text" class="form-control" name="username" placeholder="Enter Username" required="required"></div>
			</div>
        </div>
        <div class="form-group">
             <label for="email"><b>Email</b></label>
        	<input type="email" class="form-control" name="email" placeholder="Enter Email" required="required">
        </div>
		<div class="form-group">
            <label for="password"><b>Password</b></label>
            <input type="password" class="form-control" name="password" placeholder="Enter Password" required="required">
        </div>
		<div class="form-group">
            <label for="cpassword"><b>Confirm pasword</b></label>
            <input type="password" class="form-control" name="cpassword" placeholder="Confirm Password" required="required">
        </div>
		<div class="form-group">
            <button type="submit" name="save" class="btn btn-success btn-lg btn-block">Register Now</button>
        </div>
        <div class="text-center">Already have an account? <a href="login_page.php">Sign in</a></div>
    </form>

</div>
</body>
</html>