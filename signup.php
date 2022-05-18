<?php
	require "boot.php";
	require_once "pdo.php";

	session_start();

	if(isset($_POST['mail']) && isset($_POST['usname']) && isset($_POST['phnumber'])&& isset($_POST['pass'])&& isset($_POST['cpass'])&& isset($_POST['city']) && isset($_POST['state'])){

		$email = $_POST['mail'];
		$username = $_POST['usname'];
		$phnumber = $_POST['phnumber'];
		$pass = $_POST['pass'];
		$cpass = $_POST['cpass'];
		$city = $_POST['city'];
		$state = $_POST['state'];

		//Salt hash
		$salt = "Xy_12*$#abc_";
		$pass = $salt.$pass;
		$hash = hash("sha256", $pass);



		$sql = "INSERT INTO signup(email, username, pass, phone, city, state)
		VALUES(:em,:u, :p, :ph, :c, :s)";

		$stmt = $pdo->prepare($sql);
		$stmt->execute(array(
			':em'=> $email,
			':u' => $username,
			':p' => $hash,
			':ph'=> $phnumber,
			':c' => $city,
			':s' => $state
		));

		header("Location: signup.php");
		$_SESSION['success'] = "Congratulations! You are registered successfully";
		return;

	}



	
?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Signup page</title>
		<script type="text/javascript" src="script.js"></script>
	</head>
	<body style= "font-family: sans-serif;">
		<header>
			<h1 class="fw-bolder" style="color: #3a403e;">SignUp</h1>	
		</header>
 	 		<?php
			if(isset($_SESSION['success'])){
				echo ('<div class="alert alert-success start-50 translate-middle-x"  style="width: 60%; border-radius: 15px; font-size: 14px; transition:" role="alert">'.htmlentities($_SESSION['success']).'</div>');
				unset($_SESSION['success']);
			}

			?>

		<div class="container" id="signup-container">
			<form class="row g-3 " method="POST" autocomplete="off" onsubmit="return validation()" novalidate>
			  <div class="col-md-6">
			    <label for="inputEmail4" class="form-label">Email</label>
			    <input type="email" class="form-control" name = "mail" id="inputEmail4" placeholder="abc@example.com" >
			  </div>
			  <div class="col-md-6">
			  	<label for="username" class="form-label">Username</label>
			    <input type="text" class="form-control" name = "usname" id="username" >
			  </div>
			  <div class="col-md-6">
			    <label for="inputPassword4" class="form-label">Password</label>
			    <input type="password" class="form-control" id="inputPassword4" name = "pass">
			  </div>
			  <div class="col-md-6">
			    <label for="inputPassword5" class="form-label">Confirm Password</label>
			    <input type="password" class="form-control" id="inputPassword5" name = "cpass">
			  </div>
			  <div id="emailHelp" class="form-text">Password must contain atleast one uppercase, lowercase letter and a number</div>
			  <div class="col-12">
			    <label for="inputPhone" class="form-label">Phone Number</label>
			    <input type="text" class="form-control" id="inputPhone" name = "phnumber">
			  </div>
			  <div id="emailHelp" class="form-text">Ten-digit phone number</div>
			  <div class="col-md-6">
			    <label for="inputCity" class="form-label">City</label>
			    <input type="text" class="form-control" id="inputCity" name="city">
			  </div>

			  <div class="col-md-6">
			    <label for="inputState" class="form-label">State</label>
			    <input type="text" class="form-control" id="inputState" name="state">
			  </div>


			  <div class="col-md-6 ">
			    <input type="submit" class="btn btn-primary position-relative my-butt" value="Sign Up" />
			   </div>
			   <div class="col-md-6 " style="text-align: right;">
			    <a href="login.php" class="btn btn-danger position-relative my-butt" value="Login" >Login</a>
			  	</div>
			</form>
		</div>
		<div id="spinner"></div>
		
		<script>
			function hideLoader() {
			    $('#spinner').delay(3000).fadeOut();
			}

			$(window).ready(hideLoader);

			// Strongly recommended: Hide loader after 20 seconds, even if the page hasn't finished loading
			setTimeout(hideLoader, 20 * 1000);
		</script>
	</body>
</html>