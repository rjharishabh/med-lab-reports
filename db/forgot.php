<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

if (isset($_GET['email'])) {
    $email = $_REQUEST['email'];

	require_once 'connect_db.php';

	$sql='SELECT email FROM auth WHERE email=:email';
	$forg=$db->prepare($sql);
	$forg->execute(array(
	    ':email'=>$email
	));

	$row=$forg->fetch(PDO::FETCH_ASSOC);

	if ($row === false) {
	    $_SESSION['error'] = 'Email not found in our database.';
		echo 'Email not found';
	}
	else {

		$otp = '';
	    for($i=0; $i<6; $i++) {
	        $otp = $otp . mt_rand(0,9);
	    }

	    $_SESSION['otp'] = $otp;

		$mail = new PHPMailer(true);

		try {
		    $mail->isSMTP();
			$mail->Host       = 'smtp.gmail.com';
			$mail->SMTPAuth   = true;
			$mail->Username   = 'mail@gmail.com';
			$mail->Password   = 'gmailpassword';                             //SMTP password
		    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
		    $mail->Port       = 465;                        //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

		    //Recipients
		    $mail->setFrom('mail@gmail.com');
		    $mail->addAddress($email);     //Add a recipient

		    //Content
		    $mail->isHTML(true);                                  //Set email format to HTML
		    $mail->Subject = 'OTP for Password Change';
		    $mail->Body    = 'Hi,<br>Please use <strong>' . $otp . '</strong> as an OTP to change the password on medical-test-and-report-management-system website.'.
			'<br>If you have not initiated the password change request, then please ignore this email.'.
			'<br><br>Thank you<br>Rishabh Ranjan Jha<br>Developer of the website';

		    $mail->send();
		    echo 'Please enter the 6 digit OTP you have received on ' . $email;
		} catch (Exception $e) {
		    echo "OTP could not be sent.";
		}
		$_SESSION['email'] = $email;
	}

}

else if (isset($_POST['otp'])) {
    if($_POST['otp']===$_SESSION['otp']) {
        header('Location:/medical-test-and-report-management-system/change-password.php');
		return;
    }
    else {
		unset($_SESSION['otp']);
		$_SESSION['error'] = 'Incorrect OTP. Please try again.';
        header('Location:/medical-test-and-report-management-system/forgot-password.php');
		return;
    }
}

else {
	header('Location:/medical-test-and-report-management-system/');
	return;
}
