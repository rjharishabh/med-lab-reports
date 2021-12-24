<?php
session_start();

if (!isset($_SESSION['authid'])) {
    header('Location:/med-lab-reports/');
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
		<header class="container">
			<div class="row m-3">
				<div class="col-3">
					<a href="https://med-lab-reports.great-site.net/">
					<img src="imgs/icons/logo.png" width="40" height="40" alt="logo"></a>
				</div>
				<div class="col-8">
					<h3 class="text-center font-monospace">Med Lab Reports</h3>
				</div>
			</div>
		</header>

		<main class="container">
			<div class="row">
				<div class="col-md-3">
					<div class="nav flex-column nav-tabs me-3 position-fixed" role="tablist">
						<button class="nav-link active fs-5" >Profile</button>
						<button class="nav-link fs-5 dispToast">Book Tests</button>
						<button class="nav-link fs-5 dispToast" >Test Reports</button>
						<button class="nav-link fs-5 mt-auto dispToast"><img src="imgs/icons/box-arrow-right.svg" alt="logout"> Log out</button>
					</div>
				</div>

				<div class="col-md-9">
					<div class="tab-content">
						<div class="tab-pane fade show active" id="profile">
							<?php
							if (isset($_SESSION['success'])) {
								echo ('<div class="alert text-center alert-success alert-dismissible fade show" role="alert">
								<strong>'.$_SESSION["success"].'</strong><button type="button" class="btn-close"
								data-bs-dismiss="alert" aria-label="Close"></button></div>');
								unset($_SESSION['success']);
							}
							?>
							<h2>Edit Profile</h2>
							<h6 class="text-danger">* Required</h6>
							<form action="db/update-profile.php" method="post">
								<div class="row my-2">
									<div class="col-3">
										<label for="name" class="form-label" required><h5>Full Name <span class="text-danger">*</span></h5></label>
									</div>
									<div class="col-7">
										<input type="text" name="name" id="name" class="form-control" required value="<?=htmlentities($row['name'])?>" >
									</div>
								</div>

								<div class="row my-2">
									<div class="col-3">
										<label for="dob" class="form-label"><h5>Date of Birth <span class="text-danger">*</span></h5></label>
									</div>
									<div class="col-7">
										<input type="date" name="dob" id="dob" class="form-control" required value="<?=htmlentities($row['dob'])?>" >
									</div>
								</div>

								<div class="row my-2">
									<div class="col-3">
										<label for="gender" class="form-label"><h5>Gender <span class="text-danger">*</span></h5></label>
									</div>
									<div class="col-7">
										<select class="form-select" id="gender" name="gender" required value="<?=htmlentities($row['gender'])?>" >
											<option value="1" selected>Male</option>
											<option value="2">Female</option>
											<option value="3">Transgender</option>
										</select>
									</div>
								</div>

								<div class="row my-2">
									<div class="col-3">
										<label for="mobile" class="form-label"><h5>Mobile Number <span class="text-danger">*</span></h5></label>
									</div>
									<div class="col-7">
										<input type="text" name="mobile" id="mobile" maxlength="10" class="form-control" required value="<?=htmlentities($row['mobile'])?>" >
									</div>
								</div>

								<div class="row my-2">
									<div class="col-3">
										<label for="address" class="form-label"><h5>Address</h5></label>
									</div>
									<div class="col-7">
										<textarea name="address" id="address" maxlength="256" class="form-control"><?=htmlentities($row['address'])?></textarea>
									</div>
								</div>

								<div class="row my-3">
									<div class="col-md-1 offset-md-9">
										<button type="submit" class="btn btn-primary btn-block">Save</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</main>

			<!-- toast markup-->
			<div class="position-fixed top-0 end-0 p-3">
				<div id="toastBar" class="toast bg-danger text-white" role="alert">
					<div class="d-flex">
						<div class="toast-body">
							Please complete your editing and then save it.
						</div>
						<button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
					</div>
				</div>
			</div>

		<script src="js/bootstrap.bundle.min.js"></script>
		<script>
		let dispToastBtns = document.querySelectorAll('.dispToast');
		let toastBar = document.querySelector('#toastBar');
		dispToastBtns.forEach( (btn) => {
			btn.addEventListener('click', () => {
				let toast = new bootstrap.Toast(toastBar);
				toast.show();
			});
		});
		</script>
	</body>
</html>
