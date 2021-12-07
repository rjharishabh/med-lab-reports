<?php
session_start();

if(!isset($_SESSION['authid'])) {
    header('Location:/medical-test-and-report-management-system/');
    return;
}

require 'db/connect_db.php';

$sql='SELECT * FROM users WHERE uid=:uid';
$query=$db->prepare($sql);
$query->execute(array(':uid'=>$_SESSION['authid']));
$row=$query->fetch(PDO::FETCH_ASSOC);

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
        <title>Edit Profile</title>
    </head>
    <body>
		<main class="fluid-container">
			<form action="db/update-profile.php" method="post">
				<?php
				if(isset($_SESSION['success'])){
					echo ('<div class="alert text-center alert-success alert-dismissible fade show" role="alert">
					<strong>'.$_SESSION["success"].'</strong><button type="button" class="btn-close"
					data-bs-dismiss="alert" aria-label="Close"></button></div>');
					unset($_SESSION['success']);
				}
				?>
				<div class="row">
					<div class="col-4">
						<label for="name" class="form-label" required><h5>Full Name <span class="fs-6 text-danger">(Required)</span></h5></label>
					</div>
					<div class="col-7">
						<input type="text" name="name" id="name" class="form-control" required value="<?=htmlentities($row['name'])?>" >
					</div>
				</div>

				<div class="row">
					<div class="col-4">
						<label for="dob" class="form-label"><h5>Date of Birth</h5></label>
					</div>
					<div class="col-7">
						<input type="date" name="dob" id="dob" class="form-control" value="<?=htmlentities($row['dob'])?>" >
					</div>
				</div>

				<div class="row">
					<div class="col-4">
						<label for="gender" class="form-label"><h5>Gender</h5></label>
					</div>
					<div class="col-7">
						<select class="form-select" id="gender" name="gender" value="<?=htmlentities($row['gender'])?>" >
							<option value="1" selected>Male</option>
							<option value="2">Female</option>
							<option value="3">Transgender</option>
						</select>
					</div>
				</div>

				<div class="row">
					<div class="col-4">
						<label for="mobile" class="form-label"><h5>Mobile Number</h5></label>
					</div>
					<div class="col-7">
						<input type="text" name="mobile" id="mobile" maxlength="10" class="form-control" value="<?=htmlentities($row['mobile'])?>" >
					</div>
				</div>

				<div class="row">
					<div class="col-4">
						<label for="address" class="form-label"><h5>Address</h5></label>
					</div>
					<div class="col-7">
						<textarea name="address" id="address" maxlength="256" class="form-control"><?=htmlentities($row['address'])?></textarea>
					</div>
				</div>
				<button type="submit" class="btn btn-primary" name="button">Save</button>
			</form>
		</main>
		<script src="js/script.js"></script>
	</body>
</html>
