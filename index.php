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
    	<link rel="apple-touch-icon" sizes="180x180" href="imgs/favicon/apple-touch-icon.png">
    	<link rel="icon" type="image/png" sizes="32x32" href="imgs/favicon/favicon-32x32.png">
    	<link rel="icon" type="image/png" sizes="16x16" href="imgs/favicon/favicon-16x16.png">
    	<link rel="manifest" href="site.webmanifest">
    	<title>Medical Test & Report Management System</title>
    </head>
    <body>
        <main class="container">
            <div class="row mt-3">
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
                                    <button type="submit" class="btn btn-info btn-lg" name="button">Login</button>
                                </form>
                          </div>

                            <div class="tab-pane fade" id="register">
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
                                    <button type="submit" class="btn btn-info btn-lg" name="button">Continue</button>
                                </form>
                          </div>
                          </div>
                      </div>
                    </div>
                </div>
            </div>
        </main>
        <script src="js/bootstrap.bundle.min.js" ></script>
    </body>
</html>
