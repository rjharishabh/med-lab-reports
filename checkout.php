<?php
session_start();

if (!isset($_SESSION['authid'])) {
	header('Location:/medical-test-and-report-management-system/');
	return;
}

if (!isset($_POST['tid'])) {
	header('Location:/medical-test-and-report-management-system/dashboard.php');
	return;
}

require 'vendor/autoload.php';
require 'db/connect_db.php';

use Razorpay\Api\Api;

$keyId = '..........';
$keySecret = '..........';
$displayCurrency = 'INR';

$api = new Api($keyId, $keySecret);

$sql = 'SELECT * FROM auth, users, tests WHERE
	auth.id=users.uid AND tests.tid=:tid AND auth.id=:authid';
$det = $db->prepare($sql);
$det->execute(array(
	':tid'=>$_POST['tid'],
	':authid' => $_SESSION['authid']
));

$detail = $det->fetch(PDO::FETCH_ASSOC);

$orderData = [
	'amount'          => $detail['fee']*100,
	'currency'        => 'INR',
	'payment_capture' => 1
];

$razorpayOrder = $api->order->create($orderData);
$razorpayOrderId = $razorpayOrder['id'];
$_SESSION['razorpay_order_id'] = $razorpayOrderId;
$displayAmount = $amount = $orderData['amount'];

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
				<div class="col-md-8 offset-md-2">
					<div class="row m-3">
						<div class="col-3">
							<a href="https://med-lab-reports.great-site.net/">
							<img src="imgs/icons/logo.png" width="40" height="40" alt="logo"></a>
						</div>
						<div class="col-6">
							<h3 class="text-center font-monospace">Medical Test and Report Management System</h3>
						</div>
					</div>

					<div class="card border-primary">
						<div class="card-header">
							<h3 class="font-monospace text-center">Checkout</h3>
						</div>
						<div class="card-body">
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
									Age &amp; Gender : <?=htmlentities($detail['age'].' Years'); ?> &amp; <?=htmlentities($detail['gender']); ?>
								</div>
								<div class="col-md-6">
									Mobile: <?=htmlentities($detail['mobile']); ?>
								</div>
							</div>

							<div class="row">
								<div class="col-md-6">
									Order ID: <?=htmlentities($razorpayOrderId); ?>
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
										<td><?=htmlentities($detail['tid']); ?></td>
										<td><?=htmlentities($detail['test_code']); ?></td>
										<td><?=htmlentities($detail['test_name']); ?></td>
										<td><?=htmlentities($detail['fee']); ?></td>
									</tr>
									<tr>
										<th class="text-end" colspan="3">Miscellaneous Charges</th>
										<td>0</td>
									</tr>
									<tr>
										<th class="text-end" colspan="3">Total Payable Amount</th>
										<td><?=htmlentities($detail['fee']); ?></td>
									</tr>
								</tbody>
							</table>

							<div class="row">
								<div class="col">
									<a href="dashboard.php" class="btn btn-danger">Cancel</a>
								</div>
								<div class="col">
									<button id="rzp-button" class="float-end btn btn-primary">Pay &#8377; <?=htmlentities($detail['fee']); ?></button>
								</div>
							</div>

							<?php
							$image = base64_encode(file_get_contents('imgs/icons/logo.png'));
							$data = [
							    "key"               => $keyId,
							    "amount"            => $amount,
							    "name"              => $detail['name'],
							    "description"       => $detail['test_name'],
							    "image"             => "data:image/png;base64,$image",
							    "prefill"           => [
							    "name"              => $detail['name'],
							    "email"             => $detail['email'],
							    "contact"           => $detail['mobile'],
							    ],
							    "theme"             => [
							    "color"             => "#82aae5"
							    ],
							    "order_id"          => $razorpayOrderId,
							];

							$json = json_encode($data);
							 ?>

							 <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
							 <form name='razorpayform' action="db/payment-completed.php" method="post">
								 <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
								 <input type="hidden" name="razorpay_signature"  id="razorpay_signature">
								 <input type="hidden" name="tid" value="<?=htmlentities($detail['tid']); ?>">
							 </form>

							 <script>
							 	var options = <?php echo $json?>;

								 options.handler = function (response) {
									 document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
									 document.getElementById('razorpay_signature').value = response.razorpay_signature;
									 document.razorpayform.submit();
								 };

								 options.theme.image_padding = false;
								 var rzp = new Razorpay(options);

								 document.getElementById('rzp-button').onclick = function(e) {
									 rzp.open();
									 e.preventDefault();
								 }
							 </script>
						</div>
					</div>
				</div>
			</div>
		</main>
	</body>
</html>
