<?php
session_start();

if (isset($_SESSION['authid'])) {
	header('Location:/med-lab-reports/dashboard.php');
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
    	<title>Med Lab Reports</title>
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
                      <div class="card-body">
                          <ul class="nav nav-pills justify-content-center" role="tablist">
                            <li class="nav-item">
                              <button class="nav-link active" data-bs-toggle="pill" data-bs-target="#login" type="button"><h4>Login</h4></button>
                            </li>
                            <li class="nav-item">
                              <button class="nav-link" data-bs-toggle="pill" data-bs-target="#register" type="button"><h4>Register</h4></button>
                            </li>
                          </ul>
                          <div class="tab-content">
                            <div class="tab-pane fade show active" id="login">
                                <h2 class="text-center m-3">Login</h2>
                                <?php
								if (isset($_SESSION['error'])) {
									echo ('<div class="alert text-center alert-danger alert-dismissible fade show" role="alert">
									<strong>'.$_SESSION["error"].'</strong><button type="button" class="btn-close"
									data-bs-dismiss="alert" aria-label="Close"></button></div>');
									unset($_SESSION['error']);
								}
								if (isset($_SESSION['success'])) {
									echo ('<div class="alert text-center alert-success alert-dismissible fade show" role="alert">
									<strong>'.$_SESSION["success"].'</strong><button type="button" class="btn-close"
									data-bs-dismiss="alert" aria-label="Close"></button></div>');
									unset($_SESSION['success']);
								}
                                ?>
                                <form action="db/login.php" method="post">
                                    <div class="row m-3">
                                        <div class="col-4">
                                            <label for="lgnemail" class="form-label"><h5>Email</h5></label>
                                        </div>
                                        <div class="col-7">
                                            <input type="email" name="email" id="lgnemail" class="form-control" required placeholder="user@example.com">
                                        </div>
                                    </div>
                                    <div class="row m-3">
                                        <div class="col-4">
                                            <label for="lgnpassword" class="form-label"><h5>Password</h5></label>
                                        </div>
                                        <div class="col-7">
                                            <input type="password" minlength="6" maxlength="12" id="lgnpassword" class="form-control" required name="password">
                                        </div>
                                        <div class="col-1" id="view-password">
                                            <img id="login-eye" src="imgs/icons/eye-slash-fill.svg" alt="lgnpassword">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <a href="forgot-password.php" class="link-primary offset-9 col-3 text-end text-decoration-none">Forgot Password</a>
                                    </div>
                                    <button type="submit" class="btn btn-info btn-lg">Login</button>
                                </form>
                          </div>

                            <div class="tab-pane fade" id="register">
                                <h2 class="text-center m-3">Register</h2>
                                <form action="db/register.php" method="post" onsubmit="return validate(this)">
                                    <div class="row m-3">
                                        <div class="col-4">
                                            <label for="email" class="form-label"><h5>Email</h5></label>
                                        </div>
                                        <div class="col-7">
                                            <input type="email" name="email" id="email" class="form-control" required placeholder="user@example.com">
                                        </div>
                                    </div>
                                    <div class="row m-3">
                                        <div class="col-4">
                                            <label for="regpassword" class="form-label"><h5>Password</h5></label>
                                        </div>
                                        <div class="col-7">
                                            <input type="password" minlength="6" maxlength="12" class="form-control" id="regpassword" required name="password">
                                        </div>
                                        <div class="col-1" id="view-password-reg">
                                            <img id="login-eye-pass" src="imgs/icons/eye-slash-fill.svg" alt="regpassword">
                                        </div>
                                    </div>
                                    <div class="row m-3">
                                        <div class="col-4">
                                            <label for="confpassword" class="fomr-label"><h5>Confirm Password</h5></label>
                                        </div>
                                        <div class="col-7">
                                            <input type="password" minlength="6" maxlength="12" class="form-control" id="confpassword" required name="confpassword">
                                        </div>
                                        <div class="col-1" id="view-cpassword-reg">
                                            <img id="login-eye-cpass" src="imgs/icons/eye-slash-fill.svg" alt="confpassword">
                                        </div>
                                    </div>
									<button type="button" class="btn btn-info" id="otpreg">Get OTP on Email</button>
									<div class="row m-3">
										<p id="resText" class="fs-5 text-primary"></p>
									</div>
									<div id="otp-block">
	                                    <div class="row m-3">
	                                        <div class="col-4">
	                                            <label for="otp" class="form-label"><h5>Enter OTP</h5></label>
	                                        </div>
	                                        <div class="col-7">
	                                            <input type="text" name="otp" id="otp" class="form-control" required placeholder="123456">
	                                        </div>
	                                    </div>
	                                    <button type="submit" class="btn btn-info btn-lg">Register</button>
	                                </div>
                                </form>
                          </div>
                          </div>
                      </div>
                    </div>
				</div>
			</div>
        </main>
		<script>
			function validate(form) {
				if (form.email.value.indexOf('.') > 0) {
					return true;
				}
				else {
					alert('Please enter a valid email.');
					return false;
				}
		}
		</script>
        <script src="js/script.js"></script>
        <script src="js/bootstrap.bundle.min.js" ></script>
    </body>
</html>
