<?php
session_start();

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
		<main class="fluid-container">
			<div class="row">
				<div class="col-md-2">
					<div class="nav flex-column nav-tabs me-3" role="tablist">
						<button class="nav-link active fs-5" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-selected="true">Profile</button>
						<button class="nav-link fs-5" data-bs-toggle="tab" data-bs-target="#tests" type="button" role="tab" aria-selected="false">Add Test</button>
						<button class="nav-link fs-5" data-bs-toggle="tab" data-bs-target="#reports" type="button" role="tab" aria-selected="false">Test Reports</button>
						<a class="m-auto text-decoration-none fs-5" href="logout.php"><img id="logout" src="imgs/icons/box-arrow-right.svg" alt=""> Log out</a>
					</div>
				</div>

				<div class="col-md-10">
					<div class="tab-content">
						<div class="tab-pane fade show active" id="profile">
							<div class="row">
								<div class="col-md-5">
									<h2>Hi <?=htmlentities($row['name']); ?></h2>
								</div>
								<div class="col-md-3">
								</div>
								<div class="col-md-3">
									<a href="delete-profile.php" class="btn btn-danger float-end">Delete Profile</a>
									<a href="edit-profile.php" class="btn btn-warning float-end">Edit Profile</a>
								</div>
							</div>

							<div class="row">
								<div class="col-4">
									<label class="form-label"><h5>Registered Email</h5></label>
								</div>
								<div class="col-7">
									<input type="email" disabled class="form-control" value="<?=htmlentities($row['email'])?>" >
								</div>
							</div>

							<div class="row">
								<div class="col-4">
									<label class="form-label"><h5>Date of Birth</h5></label>
								</div>
								<div class="col-7">
									<input type="date" disabled class="form-control" value="<?=htmlentities($row['dob'])?>" >
								</div>
							</div>

							<div class="row">
								<div class="col-4">
									<label class="form-label"><h5>Age (in years)</h5></label>
								</div>
								<div class="col-7">
									<input type="number" disabled class="form-control" value="<?=htmlentities($row['age'])?>" >
								</div>
							</div>

							<div class="row">
								<div class="col-4">
									<label class="form-label"><h5>Gender</h5></label>
								</div>
								<div class="col-7">
									<input type="text" disabled class="form-control" value="<?=htmlentities($row['gender'])?>" >
								</div>
							</div>

							<div class="row">
								<div class="col-4">
									<label class="form-label"><h5>Mobile Number</h5></label>
								</div>
								<div class="col-7">
									<input type="text" disabled class="form-control" value="<?=htmlentities($row['mobile'])?>" >
								</div>
							</div>

							<div class="row">
								<div class="col-4">
									<label class="form-label"><h5>Address</h5></label>
								</div>
								<div class="col-7">
									<textarea type="text" disabled class="form-control" > <?=htmlentities($row['address'])?> </textarea>
								</div>
							</div>

						</div>
						<div class="tab-pane fade" id="tests">
							<h2>Add Tests</h2>
							<?php
							$tests=$db->prepare('SELECT * FROM tests');
							$tests->execute();
							$tests_row=$tests->fetchall(PDO::FETCH_ASSOC);?>
							<div class="col-md-8">
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
							$sql='SELECT test_no, date_and_time, test_code, test_name FROM tests_conducted AS tc, tests AS t WHERE tc.user_id=:userid AND t.tid=tc.test_id ORDER BY tc.test_no';
							$tests=$db->prepare($sql);
							$tests->execute(array(':userid' => $_SESSION['authid']));
							$tests_row=$tests->fetchall(PDO::FETCH_ASSOC);
							?>
							<div class="col-md-8">
								<table class="table table-striped table-bordered">
									<thead>
										<tr>
											<th>Test No.</th>
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
											<td>$value[test_no]</td>
											<td>$value[test_code]</td>
											<td>$value[test_name]</td>
											<td>$value[date_and_time]</td>
											<form method='post' action='view-result.php' target='_blank'>
											<input type='hidden' name='tid' value='$value[test_no]'>
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
