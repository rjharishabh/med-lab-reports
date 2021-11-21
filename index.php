<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/styles.css">
	<link rel="apple-touch-icon" sizes="180x180" href="imgs/favicon/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="imgs/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="imgs/favicon/favicon-16x16.png">
	<link rel="manifest" href="site.webmanifest">
	<title>Medical Test & Report Management System</title>
	<script src="js/script.js" defer></script>
</head>
<body>
<main class="container">
	<div class="row mt-3">
		<div class="col-md-6 offset-md-3">
			<div class="card text-dark border-primary text-center">
			  <div class="card-header border-primary">
				  <div class="row">
					  <button type="button" class="btn btn-secondary col-5" disabled data-bs-toggle="collapse" data-bs-target="#login"><h4>Login</h4></button>
					  <button type="button" class="btn btn-info offset-2 col-5" data-bs-toggle="collapse" data-bs-target="#register"><h4>Register</h4></button>
				  </div>
			  </div>
			  <div class="card-body">
				  <div class="collapse show" id="login">
					  <h2 class="text-center">Login</h2>
					  <form action="db/login.php" method="post">
		  				<div class="row m-3">
		  					<div class="col-4">
		  					   <label for="lgnemail" class="form-label"><h5>Email</h5></label>
		  					</div>
		  				  <div class="col-8">
		  					  <input type="email" name="email" id="lgnemail" class="form-control" required placeholder="user@example.com">
		  				  </div>
		  				</div>
		  				<div class="row m-3">
		  				   <div class="col-4">
		  					  <label for="lgnpassword" class="form-label"><h5>Password</h5></label>
		  				   </div>
		  				  <div class="col-8">
		  					 <input type="password" id="lgnpassword" class="form-control" required name="password">
		  				  </div>
		  				</div>
						<button type="submit" class="btn btn-primary" name="button">Login</button>
		  			</form>
				  </div>

				  <div class="collapse" id="register">
					   <h2 class="text-center">Register</h2>
					  <form action="db/register.php" method="post">
						<div class="row m-3">
							<div class="col-4">
							   <label for="email" class="form-label"><h5>Email</h5></label>
							</div>
						  <div class="col-8">
							  <input type="email" name="email" id="email" class="form-control" required placeholder="user@example.com">
						  </div>
						</div>
						<div class="row m-3">
						   <div class="col-4">
							  <label for="password" class="form-label"><h5>Password</h5></label>
						   </div>
						  <div class="col-8">
							 <input type="password" class="form-control" id="password" required name="password">
						  </div>
						</div>
						<div class="row m-3">
						   <div class="col-4">
							  <label for="confpassword" class="fomr-label"><h5>Confirm Password</h5></label>
						   </div>
						  <div class="col-8">
							 <input type="password" class="form-control" id="confpassword" required name="confpassword">
						  </div>
						</div>
						<button type="submit" class="btn btn-primary" name="button">Continue</button>
					</form>
				  </div>
			  </div>
			</div>
		</div>
	</div>
</main>
	<script src="js/bootstrap.bundle.min.js" ></script>
</body>
</html>
