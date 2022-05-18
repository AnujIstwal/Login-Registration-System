<?php
	require "boot.php";
	require_once "pdo.php";
	session_start();


	
	$stmt = $pdo->query(
        'SELECT
        email,
        pass
        FROM signup'
		);

    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);


	if(isset($_POST['mail']) && isset($_POST['pass'])){
		if(strlen($_POST['mail']) < 1 || strlen($_POST['pass']) < 1){
			$_SESSION['err'] = "Email or Password missing";
		}
		else{
		

			if(mail_validate($_POST['mail']) && pass_validate($rows)){
				$_SESSION['success'] = "Logged in successfully";
				$_SESSION['name'] = $_POST['mail'];
				setcookie("user", $_POST['mail'], time() + (86400 * 30), "/");
				header("Location: index.php");
				return;
			}

			else{
				$_SESSION['err'] = "Oops! Incorrect password or email";
				$mail = htmlentities($_POST['mail']);
			}
		}

		header("Location: login.php");
		return;
	}

	function mail_validate($mail){
		if(!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $mail)){
			return false;
		}
		return true;

	}

	function pass_validate($rows){
		if(count($rows) > 0){
			foreach($rows as $row){

				$hash = hash('sha256',"Xy_12*$#abc_".$_POST['pass']);

				if(($hash == $row['pass']) && ($_POST['mail'] == $row['email'])){
					return true;
				}			
			}
		}
		return false;
	}
?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<title>Login Page</title>
	</head>
	<body style= "font-family: sans-serif;">
		<header>
				<h1 class="fw-bolder" style="color: #3a403e;">Login</h1>	
		</header>
 	 		<?php
			if(isset($_SESSION['err'])){
				echo ('<div class="alert alert-danger position-relative start-50 translate-middle-x"  style="width: 60%; border-radius: 15px; font-size: 14px;" role="alert">'.htmlentities($_SESSION['err']).'</div>');
				unset($_SESSION['err']);
			}

			?>

		
		<div class="container" id ="login-container" >
		<form method="POST" novalidate>
		 	<div class="mb-3">
		    	<label for="exampleInputEmail1" class="form-label">Email address</label>
		    	<input type="email" class="form-control" name="mail" id="exampleInputEmail1" aria-describedby="emailHelp" >
		    	<div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
		  	</div>
		  	<div class="mb-3">
		    	<label for="exampleInputPassword1" class="form-label">Password</label>
		    	<input type="password" class="form-control" name="pass" id="exampleInputPassword1">
		  	</div>
		  	<div class="mb-3 form-check" style="margin:2%; ">
		    	<input type="checkbox" class="form-check-input" id="exampleCheck1">
		    	<label class="form-check-label" for="exampleCheck1">Remember Me</label><br>
		    
		  	</div>

		  	<button type="submit" class="btn btn-primary " style="width: 100px;margin: 1%;border-radius: 10px; max-width: 100px;">Submit</button>
		  	<a  href="signup.php" style="float: right;margin: 2%;text-decoration: underline;">Create new account</a>
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