<?php
session_start();
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
        <script src="js/script.js" defer></script>
        <title>Forgot Password</title>
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
                        <h4 class="mt-3">Forgot Password</h4>
                      <div class="card-body">
                          <form action="db/forgot.php" method="post">
                              <div class="row">
								  <?php
                                  if(isset($_SESSION['error'])){
                                    echo ('<div class="alert text-center alert-danger alert-dismissible fade show" role="alert">
                        <strong>'.$_SESSION["error"].'</strong><button type="button" class="btn-close"
                        data-bs-dismiss="alert" aria-label="Close"></button></div>');
                                    unset($_SESSION['error']);
                                  }
                                  ?>
                              </div>
                              <div class="row m-3">
                                  <div class="col-4">
                                      <label for="email" class="form-label"><h5>Email</h5></label>
                                  </div>
                                  <div class="col-8">
                                      <input type="email" name="email" id="email" class="form-control" required placeholder="user@example.com">
                                  </div>
                              </div>
                              <button type="button" class="btn btn-primary" id="otpbtn">Get OTP on Email</button>
							  <div class="row m-3">
								  <p id="resText" class="fs-5 text-primary"></p>
							  </div>
							  <div id="otp-block">
                                  <div class="row m-3">
                                      <div class="col-4">
                                          <label for="otp" class="form-label"><h5>Enter OTP</h5></label>
                                      </div>
                                      <div class="col-8">
                                          <input type="text" name="otp" id="otp" class="form-control" required placeholder="123456">
                                      </div>
                                  </div>
                                  <button type="submit" class="btn btn-primary btn-lg" id="otpbtn">Confirm</button>
                              </div>
                          </div>
                      </form>
                      </div>
                    </div>
                </div>
            </div>
        </main>
		<script src="js/bootstrap.bundle.min.js"></script>
    </body>
</html>
