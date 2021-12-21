<?php
session_start();

if (!isset($_POST['payId'])) {
	header('Location:/medical-test-and-report-management-system/dashboard.php');
	return;
}

require 'db/connect_db.php';
require 'vendor/autoload.php';

use Dompdf\Dompdf;

$sql = 'SELECT * FROM auth, users, tests, tests_conducted WHERE
	auth.id=users.uid AND tests.tid=tests_conducted.test_id AND
	tests_conducted.payment_id=:pay_id AND auth.id=:authid';
$det = $db->prepare($sql);
$det->execute(array(
	':pay_id'=>$_POST['payId'],
	':authid' => $_SESSION['authid']));

$detail = $det->fetch(PDO::FETCH_ASSOC);

// instantiate and use the dompdf class
$dompdf = new Dompdf();

$html = '<title>Test Result</title>
<style>
table {
	width:100%;
}
.table,.table thead {
  border: 1px solid black;
  line-height: 30px;
  border-collapse: collapse;
}
.text-center {
	text-align:center !important;
}
</style>';

$html = $html . "
<h2 class='text-center'>Medical Test and Report Management System</h2>
<h2 class='text-center'>Test Result</h2><br>
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
			<td>Report Status: Final</td>
			<td>Payment ID: $detail[payment_id]</td>
		</tr>
	</tbody>
</table>
<br>
<table class='table'>
	<thead>
		<tr>
			<th>Test Code</th>
			<th>Test Name</th>
			<th>Results</th>
			<th>Units</th>
			<th>Bio. Ref. Interval</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td class='text-center'>$detail[test_code]</td>
			<td class='text-center'>$detail[test_name]</td>
			<td class='text-center'>$detail[results]</td>
			<td class='text-center'>$detail[units]</td>
			<td class='text-center'>$detail[bio_ref_interval]</td>
		</tr>
	</tbody>
</table>";

$dompdf->loadHtml($html);

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream('test_result.pdf', array('Attachment'=>0));

?>
