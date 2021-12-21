<?php
session_start();

if (!isset($_SESSION['authid'])) {
	header('Location:/medical-test-and-report-management-system/');
	return;
}

if (isset($_SESSION['payment'])) {
	unset($_SESSION['payment']);
}

require 'db/connect_db.php';

$sql='SELECT * FROM auth,users WHERE auth.id=users.uid AND auth.id=:id';
$query=$db->prepare($sql);
$query->execute(array(':id'=>$_SESSION['authid']));
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
        <title>Dashboard</title>
    </head>
    <body>
		<header class="container">
			<div class="row m-3">
				<div class="col-3">
					<a href="https://med-lab-reports.great-site.net/">
					<img src="imgs/icons/logo.png" width="40" height="40" alt="logo"></a>
				</div>
				<div class="col-6">
					<h3 class="text-center font-monospace">Medical Test and Report Management System</h3>
				</div>
			</div>
		</header>
		<main class="container">
			<div class="row">
				<div class="col-md-3">
					<div class="nav flex-column nav-tabs me-3 position-fixed" role="tablist">
						<button class="nav-link active fs-5" data-bs-toggle="tab" data-bs-target="#profile" aria-selected="true">Profile</button>
						<button class="nav-link fs-5" data-bs-toggle="tab" data-bs-target="#tests" aria-selected="false">Book Tests</button>
						<button class="nav-link fs-5" data-bs-toggle="tab" data-bs-target="#reports" aria-selected="false">Test Reports</button>
						<a class="nav-link text-decoration-none fs-5 text-center mt-auto" href="logout.php"><img src="imgs/icons/box-arrow-right.svg" alt="logout"> Log out</a>
					</div>
				</div>

				<div class="col-md-9">
					<div class="tab-content">
						<div class="tab-pane fade show active" id="profile">
							<div class="row my-3">
								<div class="col-md-6">
									<h3 class="font-monospace">Hi <?=htmlentities($row['name']); ?></h2>
								</div>
								<div class="col-md-2">
									<a href="edit-profile.php" class="btn btn-info">Edit Profile</a>
								</div>
								<div class="col-md-2">
									<a href="delete-profile.php" class="btn btn-danger">Delete Profile</a>
								</div>
							</div>

							<div class="row my-2">
								<div class="col-3">
									<label class="form-label"><h5>Registered Email</h5></label>
								</div>
								<div class="col-7">
									<input type="email" disabled class="form-control" value="<?=htmlentities($row['email'])?>" >
								</div>
							</div>

							<div class="row my-2">
								<div class="col-3">
									<label class="form-label"><h5>Date of Birth</h5></label>
								</div>
								<div class="col-7">
									<input type="date" disabled class="form-control" value="<?=htmlentities($row['dob'])?>" >
								</div>
							</div>

							<div class="row my-2">
								<div class="col-3">
									<label class="form-label"><h5>Age (in years)</h5></label>
								</div>
								<div class="col-7">
									<input type="number" disabled class="form-control" value="<?=htmlentities($row['age'])?>" >
								</div>
							</div>

							<div class="row my-2">
								<div class="col-3">
									<label class="form-label"><h5>Gender</h5></label>
								</div>
								<div class="col-7">
									<input type="text" disabled class="form-control" value="<?=htmlentities($row['gender'])?>" >
								</div>
							</div>

							<div class="row my-2">
								<div class="col-3">
									<label class="form-label"><h5>Mobile Number</h5></label>
								</div>
								<div class="col-7">
									<input type="text" disabled class="form-control" value="<?=htmlentities($row['mobile'])?>" >
								</div>
							</div>

							<div class="row my-2">
								<div class="col-3">
									<label class="form-label"><h5>Address</h5></label>
								</div>
								<div class="col-7">
									<textarea type="text" disabled class="form-control" > <?=htmlentities($row['address'])?> </textarea>
								</div>
							</div>

						</div>
						<div class="tab-pane fade" id="tests">
							<h2>Book Tests</h2>
							<?php
							$tests=$db->prepare('SELECT * FROM tests');
							$tests->execute();
							$tests_row=$tests->fetchall(PDO::FETCH_ASSOC);?>
							<div class="col-md-10">
								<table class="table table-striped table-bordered">
									<thead>
										<tr>
											<th>Test Id</th>
											<th>Test Code</th>
											<th class="text-center">Test Name</th>
											<th>Fees (&#8377;)</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<?php
										foreach ($tests_row as $key => $value) {
											echo ("<tr>
											<td>$value[tid]</td>
											<td>$value[test_code]</td>
											<td>$value[test_name]</td>
											<td>$value[fee]</td>
											<form method='post' action='checkout.php'>
											<input type='hidden' name='tid' value='$value[tid]'>
											<td class='text-center'><button type='submit' class='btn btn-sm btn-info'>Book Test</button></td>
											</form></tr>");
										}
										?>
									</tbody>
								</table>
							</div>
						</div>

						<div class="tab-pane fade" id="reports">
							<h2>Test Reports</h2>
							<?php
							$sql='SELECT payment_id, date_and_time, test_code, test_name FROM tests_conducted AS tc, tests AS t WHERE tc.user_id=:userid AND t.tid=tc.test_id ORDER BY tc.test_no';
							$tests=$db->prepare($sql);
							$tests->execute(array(':userid' => $_SESSION['authid']));
							$tests_row=$tests->fetchall(PDO::FETCH_ASSOC);
							?>
							<div class="col-md-10">
								<table class="table table-striped table-bordered">
									<thead>
										<tr>
											<th>Payment ID</th>
											<th>Test Code</th>
											<th class="text-center">Test Name</th>
											<th>Date &amp; Time</th>
											<th>View Result</th>
											<th>View Invoice</th>
										</tr>
									</thead>
									<tbody>
										<?php
										foreach ($tests_row as $key => $value) {
											echo ("<tr>
											<td>$value[payment_id]</td>
											<td>$value[test_code]</td>
											<td>$value[test_name]</td>
											<td>$value[date_and_time]</td>
											<form method='post' action='view-result.php' target='_blank'>
											<input type='hidden' name='payId' value='$value[payment_id]'>
											<td class='text-center'><button type='submit' class='btn btn-sm btn-light'><img src='imgs/icons/eye-fill.svg'></button></td>
											<td class='text-center'><button type='submit' class='btn btn-sm btn-light' formaction='invoice.php' formmethod='post'><img src='imgs/icons/eye-fill.svg'></button></td>
											</form></tr>");
										}
										?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</main>
			<script src="js/bootstrap.bundle.min.js" ></script>
		</body>
</html>
