<?php
session_start();

if (!isset($_POST['razorpay_payment_id'])) {
	header('Location:/medical-test-and-report-management-system/dashboard.php');
	return;
}

require '../vendor/autoload.php';

use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

$keyId = '..........';
$keySecret = '..........';

$success = true;

if (empty($_POST['razorpay_payment_id']) === false)
{
    $api = new Api($keyId, $keySecret);

    try {
        $attributes = array(
            'razorpay_order_id' => $_SESSION['razorpay_order_id'],
            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
            'razorpay_signature' => $_POST['razorpay_signature']
        );

        $api->utility->verifyPaymentSignature($attributes);

		require 'connect_db.php';
		require 'tests_result.php';

		$tid = intval($_POST['tid']);
		$result = test_results($tid);

		$sql = 'INSERT INTO tests_conducted (user_id, test_id, date_and_time, results, order_id, payment_id) VALUES (:userid, :testid, :date_time, :result, :o_id, :p_id)';
		$query = $db->prepare($sql);
		$query->execute(array(
			':userid' => $_SESSION['authid'],
			':testid' => $tid,
			':date_time' => date('Y-m-d h:i:s'),
			':result' => $result,
			':o_id' => $_SESSION['razorpay_order_id'],
			':p_id' => $_POST['razorpay_payment_id']
		));

		unset($_SESSION['razorpay_order_id']);

    }
    catch(SignatureVerificationError $e) {
        $success = false;
        $error = 'Error : ' . $e->getMessage();
    }
}

if ($success === true) {
	$_SESSION['payment'] = $_POST['razorpay_payment_id'];
	header('Location:../invoice.php?payId='.$_POST['razorpay_payment_id']);
	return;
}
else {
	$_SESSION['payment'] = $error;
	header('Location:../payment-failed.php');
	return;
}
