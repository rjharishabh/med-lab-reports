<?php
session_start()
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="icon" type="image/ico" href="imgs/favicon/favicon.ico">
        <link rel="apple-touch-icon" sizes="180x180" href="imgs/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="imgs/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="imgs/favicon/favicon-16x16.png">
        <link rel="manifest" href="site.webmanifest">
        <title>Change Password</title>
    </head>
    <body>
        <main class="container">
            <div class="row mt-3">
                <div class="col-md-6 offset-md-3">
                    <div class="card border-primary text-center">
                        <h4 class="mt-3">Change Password</h4>
                      <div class="card-body">
                          <form action="db/forgot.php" method="post">
                              <div class="row m-3">
                                  <div class="col-4">
                                      <label for="newpass" class="form-label"><h5>New Password</h5></label>
                                  </div>
                                  <div class="col-8">
                                      <input type="password" minlength="6" maxlength="12" name="newpass" id="newpass" class="form-control" required>
                                  </div>
                              </div>
                              <div class="row m-3">
                                  <div class="col-4">
                                      <label for="confpass" class="form-label"><h5>Confirm Password</h5></label>
                                  </div>
                                  <div class="col-8">
                                      <input type="password" minlength="6" maxlength="12" name="confpass" id="confpass" class="form-control" required>
                                  </div>
                              </div>
                                  <button type="submit" class="btn btn-primary btn-lg">Confirm</button>
                          </form>
                      </div>
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>
