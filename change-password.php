<?php
session_start();

if (!isset($_SESSION['email'])) {
	header('Location:/med-lab-reports/');
	return;
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/styles.css">
        <link rel="icon" type="image/ico" href="imgs/favicon/favicon.ico">
        <link rel="apple-touch-icon" sizes="180x180" href="imgs/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="imgs/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="imgs/favicon/favicon-16x16.png">
        <link rel="manifest" href="site.webmanifest">
        <title>Change Password</title>
    </head>
    <body>
        <main class="container">
			<div class="row m-3">
				<div class="col-md-6 offset-md-3">
					<div class="row">
						<div class="col-1">
							<a href="https://med-lab-reports.great-site.net/">
							<img src="imgs/icons/logo.png" width="40" height="40" alt="logo"></a>
						</div>
						<div class="col">
							<h3 class="text-center font-monospace">Med Lab Reports</h3>
						</div>
					</div>
				</div>
			</div>
            <div class="row m-3">
                <div class="col-md-6 offset-md-3">
                    <div class="card border-primary text-center">
                        <h4 class="mt-3">Change Password</h4>
                      <div class="card-body">
						  <?php
						  if(isset($_SESSION['error'])){
							echo ('<div class="alert text-center alert-danger alert-dismissible fade show" role="alert">
				<strong>'.$_SESSION["error"].'</strong><button type="button" class="btn-close"
				data-bs-dismiss="alert" aria-label="Close"></button></div>');
							unset($_SESSION['error']);
						  }
						  ?>
                          <form action="db/update-password.php" method="post">
                              <div class="row m-3">
								  <div class="col-4">
                                      <label for="regpassword" class="form-label"><h5>New Password</h5></label>
                                  </div>
                                  <div class="col-7">
                                      <input type="password" minlength="6" maxlength="12" name="newpass" id="regpassword" class="form-control" required>
                                  </div>
								  <div class="col-1" id="view-password-reg">
									  <img id="login-eye-pass" src="imgs/icons/eye-slash-fill.svg" alt="regpassword">
								  </div>
                              </div>
                              <div class="row m-3">
                                  <div class="col-4">
                                      <label for="confpassword" class="form-label"><h5>Confirm Password</h5></label>
                                  </div>
                                  <div class="col-7">
                                      <input type="password" minlength="6" maxlength="12" name="confpass" id="confpassword" class="form-control" required>
                                  </div>
								  <div class="col-1" id="view-cpassword-reg">
									  <img id="login-eye-cpass" src="imgs/icons/eye-slash-fill.svg" alt="confpassword">
								  </div>
                              </div>
                                  <button type="submit" class="btn btn-info btn-lg">Confirm</button>
                          </form>
                      </div>
                    </div>
                </div>
            </div>
        </main>
		<script src="js/script.js"></script>
		<script src="js/bootstrap.bundle.min.js"></script>
    </body>
</html>
