<?php require_once("php/page_start.php"); ?>

<?php

	// hardcoded user & pass
	$user = "admin";
	$password = "password";

	// check if user & pass are correct - if so, log in
	if(isset($_POST['username']) && !empty($_POST['username']) AND isset($_POST['password']) && !empty($_POST['password'])){
		$username_attempt = $_POST['username'];
        $password_attempt = $_POST['password'];

		// start new session
		session_name("login");
		session_start();
		
	 	$_SESSION['loggedin'] = TRUE;
	 	
	 	$date = date("F j, Y g:i a");
	 	// expire in 10 minutes (600 seconds)
	 	$expire = time()+600;
	 	setcookie("loggedin",$date,$expire,'/');
	 	
	 	// logged in, redirect to admin page
	 	header("location: admin.php");
	} else {
	 	echo "Invalid Login";
	}
	 
	// check if they have logged in before
	if(isset($_SESSION['loggedin'])){
	 	// have logged in before, so redirect
	 	header("location: admin.php");
	}

?>

<!-- Head -->
<?php echo $lib->get_head("Hyeonseok | Login"); ?>

<!-- Navigation -->
<?php echo $lib->get_nav(); ?>

<!-- Header/Intro Section -->
<?php echo $lib->get_header("", "LOGIN"); ?>

<!-- Login Form -->
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" style="width:100%;">
	<div class="form-group row">
	    <input type="text" class="form-control" name="username" placeholder="Username">
	    <input type="text" class="form-control" name="password" placeholder="Password">
	</div>
	<button type="submit" class="btn btn-default">Sign In</button>
</form>

<!-- Footer -->
<?php echo $lib->get_footer(); ?>