<?php
	require "boot.php";
	require "pdo.php";
	session_start();

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Login & Registration System</title>

		<script>
		$(document).ready(function(){
		  $("#myInput").on("keyup", function() {
		    var value = $(this).val().toLowerCase();
		    $("#myTable tr").filter(function() {
		      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		    });
		  });
		});
		</script>
	</head>

	<body style= "font-family: sans-serif;">


		<header>
			<?php
				echo ''; 
				if(isset($_SESSION['name']))
					echo '<div class="px-4 py-5 my-5 text-center" style="margin-top:-60px !important;"><img class="d-block mx-auto mb-4" src="images/main.svg" alt="" width="78"><h1 class="display-5 fw-bold" style="color: #3a403e;">Welcome <h2><span class="badge bg-secondary">'.$_SESSION["name"].'</span></h2></h1></div>';
				else {
					echo '<div class="px-4 py-5 my-5 text-center"><img class="d-block mx-auto mb-4" src="images/main.svg" alt="" width="78">
					<h1 class="display-5 fw-bold" style="color: #3a403e;">Welcome</h1>';
					echo '<div class="col-lg-6 mx-auto">
					<p class="lead mb-4" style=" font-family:\'Segoe UI\', Arial">Hello! Welcome to my Login & Registration System.
					You can access it on any device because this is fully responsive. In this 
					I have created a login & signup page. The users should set their password according to the guidelines only. Moreover, the strong validation will led to proper data entry.Let\'s start! 
					</p>
					<div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
						<a  href="login.php" class="btn btn-primary btn-lg px-4 gap-3">Please Login</a>
						<a href="signup.php" class="btn btn-outline-secondary btn-lg px-4">Register</a>
						</div>
					</div>
				</div>';
		}
			?>
			
		</header>
		<main style="margin-top:-60px;">
 	 		<?php
			if(isset($_SESSION['success'])){
				echo ('<div class="alert alert-success  position-relative start-50 translate-middle-x"" id="close" style="width: 60%; border-radius: 15px; font-size: 14px;" role="alert">'.htmlentities($_SESSION['success']).'</div>');
				unset($_SESSION['success']);
			}

			if(isset($_SESSION['name'])){
				$stmt = $pdo->query("SELECT user_id, email, username, phone, city, state FROM signup");
				echo '<div class="input-group flex-nowrap">
				  <span class="input-group-text" id="addon-wrapping"><img src="images/search.svg"></span>
				  <input type="text" id = "myInput" class="form-control" placeholder="Search..." aria-label="Username" aria-describedby="addon-wrapping">
				</div>';
				echo "<br><br><div class='table-responsive'><table class='table table-hover '>
				  <thead><tr>
					<th>Sno</th>
					<th>Email</th>
					<th>Username</th>
					<th>Phone No.</th>
					<th>City</th>
					<th>State</th>
				</tr></thead> <tbody id='myTable'>";
				while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
					echo "<tr>
						<td>".htmlentities($row['user_id'])."</td>
						<td>".htmlentities($row['email'])."</td>
						<td>".htmlentities($row['username'])."</td>
						<td>".htmlentities($row['phone'])."</td>
						<td>".htmlentities($row['city'])."</td>
						<td>".htmlentities($row['state'])."</td>
					</tr>";
				}
				echo "</tbody></table></div>";
				echo "<a href='logout.php' id='login-butt' class='btn btn-primary btn-lg '>Logout</a>";
			}

			?>

		</main>
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