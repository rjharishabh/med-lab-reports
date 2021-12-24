<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if (!isset($_SESSION['authid'])) {
	header('Location:/medical-test-and-report-management-system/');
	return;
}

require 'vendor/autoload.php';

function email($to, $name, $testName, $for, $data) {
	$mail = new PHPMailer(true);

	try {
		$mail->isSMTP();
		$mail->Host       = 'smtp.gmail.com';
		$mail->SMTPAuth   = true;
		$mail->Username   = 'mail@gmail.com';
		$mail->Password   = 'gmailpassword';
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
		$mail->Port       = 465;

		//Recipients
		$mail->setFrom('mail@gmail.com', 'Rishabh Ranjan Jha');
		$mail->addAddress($to);

		//Content
		$mail->isHTML(true);
		switch ($for) {
			case 2:
				$filename = tempnam('', 'Inv');
				echo $filename;
				$handle = fopen($filename, "w");
				fwrite($handle, $data);
				fclose($handle);

				$mail->Subject = 'Invoice for ' . $testName . ' Test';
				$mail->Body    = 'Hi <strong>' . $name . '</strong>,<br>You have successfully booked the <strong>' .
				$testName . '</strong> test.<br>Please find the invoice attached in this email.' .
				'<br><br>This is a system generated email, so please do not reply to this email.';
				$mail->addAttachment($filename, 'invoice.pdf');
				$mail->send();

				unlink($filename);
				header ('Location:payment-confirmed.php');
				break;
			case 3:
				$filename = tempnam('', 'Inv');
				echo $filename;
				$handle = fopen($filename, "w");
				fwrite($handle, $data);
				fclose($handle);

				$mail->Subject = 'Test Result of ' . $testName . ' Test';
				$mail->Body    = 'Hi <strong>' . $name . '</strong>,<br>Test Result of <strong>' . $testName . '</strong>' .
				' test was successfully generated.<br>Please find the test result attached in this email.' .
				'<br><br>This is a system generated email, so please do not reply to this email.';
				$mail->addAttachment($filename, 'test_result.pdf');
				$mail->send();

				unlink($filename);
				header ('Location:dashboard.php');
				break;
		}
	} catch (Exception $e) {
		header('Location:error/wrong.php');
	}
}
