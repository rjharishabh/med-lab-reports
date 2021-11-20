<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="apple-touch-icon" sizes="180x180" href="imgs/favicon/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="imgs/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="imgs/favicon/favicon-16x16.png">
	<link rel="manifest" href="site.webmanifest">
	<title>Medical Test & Report Management System</title>
</head>
<body>
<main class="container">
	<div class="card text-center">
	  <div class="card-header">
	    <button type="button"  name="button">Login</button>
		 <button type="button" name="button">Register</button>
	  </div>
	  <div class="card-body">
		  <div id="login">
			  <form class="form-group" action="db/login.php" method="post">
  				<div class="row">
  					<div class="col-4">
  					   <label for="email">Email</label>
  					</div>
  				  <div class="col-8">
  					  <input type="email" name="email" placeholder="user@example.com">
  				  </div>
  				</div>
  				<div class="row">
  				   <div class="col-4">
  					  <label for="password">Password</label>
  				   </div>
  				  <div class="col-8">
  					 <input type="password" name="password">
  				  </div>
  				</div>
  				<div class="card-footer">
  			<button type="submit" class="btn btn-primary" name="button">Login</button>
  			</div>
  			</form>
		  </div>

		  <div id="register">
			  <form class="form-group" action="db/register.php" method="post">
				<div class="row">
					<div class="col-4">
					   <label for="email">Email</label>
					</div>
				  <div class="col-8">
					  <input type="email" name="email" placeholder="user@example.com">
				  </div>
				</div>
				<div class="row">
				   <div class="col-4">
					  <label for="password">Password</label>
				   </div>
				  <div class="col-8">
					 <input type="password" name="password">
				  </div>
				</div>

				<div class="row">
				   <div class="col-4">
					  <label for="confpassword">Confirm Password</label>
				   </div>
				  <div class="col-8">
					 <input type="password" name="confpassword">
				  </div>
				</div>

				<div class="card-footer">
			<button type="submit" class="btn btn-primary" name="button">Register</button>
			</div>
			</form>
		  </div>

	  </div>

	</div>
</main>

	<script src="js/bootstrap.bundle.min.js" ></script>
</body>
</html>
