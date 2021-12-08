<?php
session_start();

if (!isset($_POST['tid'])) {
	header('Location:/medical-test-and-report-management-system/dashboard.php');
	return;
}

require_once 'db/connect_db.php';

$sql_d='SELECT email, name, age, gender, mobile, address FROM auth,users WHERE auth.id=users.uid and auth.id=:authid';
$det=$db->prepare($sql_d);
$det->execute(array(':authid' => $_SESSION['authid']));
$detail=$det->fetch(PDO::FETCH_ASSOC);

$sql_t='SELECT tid, test_code, test_name, fee FROM tests WHERE tid=:tid';
$t=$db->prepare($sql_t);
$t->execute(array(':tid' => $_POST['tid']));
$test=$t->fetch(PDO::FETCH_ASSOC);

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
        <title>Checkout</title>
	</head>
	<body>
		<main class="container">
			<div class="row">
				<h3 class="text-center">Checkout</h3>
			</div>
			<br>
			<div class="row">
				<div class="col-md-6">
					Name: <?=htmlentities($detail['name']); ?>
				</div>
				<div class="col-md-6">
					Email: <?=htmlentities($detail['email']); ?>
				</div>
			</div>

			<div class="row">
				<div class="col-md-6">
					Age: <?=htmlentities($detail['age'].' Years'); ?>
				</div>
				<div class="col-md-6">
					Mobile: <?=htmlentities($detail['mobile']); ?>
				</div>
			</div>

			<div class="row">
				<div class="col-md-6">
					Gender: <?=htmlentities($detail['gender']); ?>
				</div>
				<div class="col-md-6">
					Date & Time: <?php echo date('Y-m-d h:i:s'); ?>
				</div>
			</div>
			<br>
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Test Id</th>
						<th>Test Code</th>
						<th>Test Name</th>
						<th>Amount (&#8377;)</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><?=htmlentities($test['tid']); ?></td>
						<td><?=htmlentities($test['test_code']); ?></td>
						<td><?=htmlentities($test['test_name']); ?></td>
						<td><?=htmlentities($test['fee']); ?></td>
					</tr>
					<tr>
						<th class="text-end" colspan="3">Miscellaneous Charges</th>
						<td>0</td>
					</tr>
					<tr>
						<th class="text-end" colspan="3">Total Payable Amount</th>
						<td><?=htmlentities($test['fee']); ?></td>
					</tr>
				</tbody>
			</table>

			<div class="row">
				<form action="db/payment-completed.php" method="post">
					<input type="hidden" name="tid" value="<?php echo $test['tid']; ?>" >
					<a href="dashboard.php" class="btn btn-danger">Cancel</a>
					<button type="submit" class="float-end btn btn-primary">Pay &#8377; <?=htmlentities($test['fee']); ?></button>
				</form>
			</div>
		</main>
	</body>
</html>
