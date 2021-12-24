<?php
session_start();

use Dompdf\Dompdf;

if (!isset($_SESSION['authid'])) {
	header('Location:/med-lab-reports/');
	return;
}

if (isset($_POST['payId']) || isset($_GET['payId'])) {

	require 'db/connect_db.php';
	require 'vendor/autoload.php';

	if(isset($_GET['payId'])){
		$payId=$_GET['payId'];
	}
	else if(isset($_POST['payId'])){
		$payId=$_POST['payId'];
	}

	$sql = 'SELECT * FROM auth, users, tests, tests_conducted WHERE
		auth.id=users.uid AND tests.tid=tests_conducted.test_id AND
		tests_conducted.payment_id=:pay_id AND auth.id=:authid';
	$det = $db->prepare($sql);
	$det->execute(array(
		':pay_id'=>$payId,
		':authid' => $_SESSION['authid']
	));

	$detail = $det->fetch(PDO::FETCH_ASSOC);

	// instantiate and use the dompdf class
	$dompdf = new Dompdf();

	$html='<title>Receipt</title>
	<style>
	table {
		width:100%;
	}
	.table,.table th, .table td {
	  border: 1px solid black;
	  line-height: 30px;
	  border-collapse: collapse;
	}
	.text-center {
		text-align:center !important;
	}
	.text-right {
		text-align:right !important;
	}
	.disp {
		display: inline-block;
		margin-left: 385px;
	}
	</style>';

	$image = base64_encode(file_get_contents('imgs/icons/logo.png'));

	$html = $html . "
	<img src='data:image/png;base64,$image' width='100' height='100'>
	<span class='disp'>
	<h2 class='text-center'>Med Lab Reports</h2>
	<a href='http://med-lab-reports.great-site.net'>http://med-lab-reports.great-site.net</a>
	</span>
	<hr>
	<h2 class='text-center'>Invoice cum Receipt</h2><br>
	<table>
		<tbody>
			<tr>
				<td>Name: $detail[name]</td>
				<td>Email: $detail[email]</td>
			</tr>
			<tr>
				<td>Age & Gender : $detail[age] Years & $detail[gender]
				<td>Date & Time: $detail[date_and_time]</td>
			</tr>
			<tr>
				<td>Mobile: $detail[mobile]</td>
				<td>Order ID: $detail[order_id]</td>
			</tr>
			<tr>
				<td>Payment ID: $detail[payment_id]</td>
			</tr>
		</tbody>
	</table>
	<br>
	<table class='table'>
		<thead>
			<tr>
				<th>Test Id</th>
				<th>Test Code</th>
				<th>Test Name</th>
				<th>Amount (Rs.)</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class='text-center'>$detail[tid]</td>
				<td class='text-center'>$detail[test_code]</td>
				<td class='text-center'>$detail[test_name]</td>
				<td>$detail[fee]</td>
			</tr>
			<tr>
				<th class='text-right' colspan='3'>Miscellaneous Charges</th>
				<td>0</td>
			</tr>
			<tr>
				<th class='text-right' colspan='3'>Total Amount</th>
				<td>$detail[fee]</td>
			</tr>
		</tbody>
	</table>";

	$dompdf->loadHtml($html);

	// Render the HTML as PDF
	$dompdf->render();

	$canvas = $dompdf->getCanvas();
	$w = $canvas->get_width();
	$h = $canvas->get_height();
	$imageURL = 'imgs/icons/paid.jpg';
	$imgWidth = 500;
	$imgHeight = 250;
	$canvas->set_opacity(.1);
	$x = (($w-$imgWidth)/2);
	$y = (($h-$imgHeight)/3);
	$canvas->image($imageURL, $x, $y, $imgWidth, $imgHeight,$resolution = "normal");

	if (isset($_GET['payId'])) {
		$data = $dompdf->output();
		require 'db/email.php';
		email($detail['email'], $detail['name'], $detail['test_name'], 2, $data);
	}
	else if (isset($_POST['payId'])) {
		$dompdf->stream('receipt.pdf', array('Attachment'=>0));
	}
}
else {
	header('Location:/med-lab-reports/dashboard.php');
	return;
}

?>
