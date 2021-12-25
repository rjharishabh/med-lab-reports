<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function email($to, $name, $testName, $for, $data) {

	if ($for === 2 || $for ===3) {
		require 'vendor/autoload.php';
	}
	else if ($for === 1 || $for ===4) {
		require '../vendor/autoload.php';
	}

	$mail = new PHPMailer(true);

	try {
		$mail->isSMTP();
		$mail->Host       = 'smtp.gmail.com';
		$mail->SMTPAuth   = true;
		$mail->Username   = 'mail@gmail.com';
		$mail->Password   = 'gmailpassword';
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
		$mail->Port       = 465;

		switch ($for) {
			case 1:
				try {
					//Recipient
					$mail->setFrom('mail@gmail.com', 'Rishabh Ranjan Jha');
					$mail->addAddress($to);

					//Content
					$mail->isHTML(true);
					$mail->Subject = 'OTP for Register';
					$mail->Body    = 'Hi,<br>Please use <strong>' . $data . '</strong> as an OTP to register on med-lab-reports website.' .
					'<br>If you have not initiated the registration request, then please ignore this email.<br><br>Thank You' .
					'<br><br>This is a system generated email, so please do not reply to this email.';
					$mail->send();

					return "Please enter the 6 digit OTP you have received on $to";
				} catch (\Exception $e) {
					return "OTP could not be sent.";
				}
				break;
			case 2:
				$filename = tempnam('', 'Inv');
				echo $filename;
				$handle = fopen($filename, "w");
				fwrite($handle, $data);
				fclose($handle);

				//Recipient
				$mail->setFrom('mail@gmail.com', 'Rishabh Ranjan Jha');
				$mail->addAddress($to);

				//Content
				$mail->isHTML(true);
				$mail->Subject = 'Receipt for ' . $testName . ' Test';
				$mail->Body    = 'Hi <strong>' . $name . '</strong>,<br>You have successfully booked the <strong>' .
				$testName . '</strong> test.<br>Please find the receipt attached in this email.<br><br>Thank You' .
				'<br><br>This is a system generated email, so please do not reply to this email.';
				$mail->addAttachment($filename, 'receipt.pdf');
				$mail->send();

				unlink ($filename);
				header ('Location:payment-confirmed.php');
				break;
			case 3:
				$filename = tempnam('', 'Inv');
				echo $filename;
				$handle = fopen($filename, "w");
				fwrite($handle, $data);
				fclose($handle);

				//Recipient
				$mail->setFrom('mail@gmail.com', 'Rishabh Ranjan Jha');
				$mail->addAddress($to);

				//Content
				$mail->isHTML(true);
				$mail->Subject = 'Test Result of ' . $testName . ' Test';
				$mail->Body    = 'Hi <strong>' . $name . '</strong>,<br>Test Result of <strong>' . $testName . '</strong>' .
				' test was successfully generated.<br>Please find the test result attached in this email.<br><br>Thank You' .
				'<br><br>This is a system generated email, so please do not reply to this email.';
				$mail->addAttachment($filename, 'test_result.pdf');
				$mail->send();

				unlink ($filename);
				header ('Location:dashboard.php');
				break;
			case 4:
				try {
					//Recipient
					$mail->setFrom('mail@gmail.com', 'Rishabh Ranjan Jha');
					$mail->addAddress($to);

					//Content
					$mail->isHTML(true);
					$mail->Subject = 'OTP for Password Change';
					$mail->Body    = 'Hi <strong>' . $name . '</strong>,<br>Please use <strong>' .
					$data . '</strong> as an OTP to change the password on med-lab-reports website.' .
					'<br>If you have not initiated the password change request, then please ignore this email.<br><br>Thank You' .
					'<br><br>This is a system generated email, so please do not reply to this email.';
					$mail->send();

					return "Please enter the 6 digit OTP you have received on $to";
				} catch (\Exception $e) {
					return "OTP could not be sent.";
				}
				break;
		}
	} catch (Exception $e) {
		header ('Location:error/wrong.php');
	}
}
