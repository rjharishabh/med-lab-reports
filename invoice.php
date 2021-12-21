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
	':authid' => $_SESSION['authid']
));

$detail = $det->fetch(PDO::FETCH_ASSOC);

// instantiate and use the dompdf class
$dompdf = new Dompdf();

$html='<title>Invoice</title>
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
</style>';

$html = $html . "
<h2 class='text-center'>Medical Test and Report Management System</h2>
<h2 class='text-center'>Invoice</h2><br>
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
			<td>$detail[tid]</td>
			<td>$detail[test_code]</td>
			<td>$detail[test_name]</td>
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

// Output the generated PDF to Browser
$dompdf->stream('invoice.pdf', array('Attachment'=>0));

?>
