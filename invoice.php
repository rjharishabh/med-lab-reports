<?php
session_start();

require_once 'db/connect_db.php';
require 'vendor/autoload.php';

use Dompdf\Dompdf;

if (!isset($_SESSION['tid']) && !isset($_POST['tid']) ) {
	header('Location:/medical-test-and-report-management-system/dashboard.php');
	return;
}

$sql_d='SELECT email, name, age, gender, mobile, address FROM auth,users WHERE auth.id=users.uid and auth.id=:authid';
$det=$db->prepare($sql_d);
$det->execute(array(':authid' => $_SESSION['authid']));
$detail=$det->fetch(PDO::FETCH_ASSOC);


if (isset($_SESSION['tid'])) {
	$sql_t='SELECT tid, test_code, test_name, fee FROM tests WHERE tid=:tid';
	$t=$db->prepare($sql_t);
	$t->execute(array(':tid' => $_SESSION['tid']));
}
elseif (isset($_POST['tid'])) {
	$sql_t='SELECT tid, test_code, test_name, fee FROM tests AS t, tests_conducted AS tc WHERE tc.test_id=t.tid AND tc.test_no=:tid';
	$t=$db->prepare($sql_t);
	$t->execute(array(':tid' => $_POST['tid']));
}

$test=$t->fetch(PDO::FETCH_ASSOC);

$date=date('Y-m-d h:i:s');

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
			<td>Age: $detail[age]" . ' Years' . "</td>
			<td>Mobile: $detail[mobile]</td>
		</tr>
		<tr>
			<td>Gender: $detail[gender]</td>
			<td>Date & Time: $date</td>
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
			<td>$test[tid]</td>
			<td>$test[test_code]</td>
			<td>$test[test_name]</td>
			<td>$test[fee]</td>
		</tr>
		<tr>
			<th class='text-right' colspan='3'>Miscellaneous Charges</th>
			<td>0</td>
		</tr>
		<tr>
			<th class='text-right' colspan='3'>Total Amount</th>
			<td>$test[fee]</td>
		</tr>
	</tbody>
</table>";

$dompdf->loadHtml($html);

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream('invoice.pdf', array('Attachment'=>0));

?>
