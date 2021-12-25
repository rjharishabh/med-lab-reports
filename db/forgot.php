<?php
session_start();

if (isset($_GET['email'])) {
    $email = $_REQUEST['email'];

	require 'connect_db.php';

	$sql = 'SELECT email, name FROM auth, users WHERE email=:email AND auth.id=users.uid';
	$forg = $db->prepare($sql);
	$forg->execute(array(
	    ':email' => $email
	));

	$row = $forg->fetch(PDO::FETCH_ASSOC);

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

		require 'email.php';

		$res = email($email, $row['name'], '', 4, $otp);
		echo $res;

		$_SESSION['email'] = $email;
	}

}
else if (isset($_POST['otp'])) {
    if($_POST['otp'] === $_SESSION['otp']) {
		if ($_POST['email'] === $_SESSION['email']) {
			header('Location:/med-lab-reports/change-password.php');
			return;
		}
		else {
			unset($_SESSION['otp']);
			unset($_SESSION['email']);
			$_SESSION['error'] = "Email is not correct. <br>Please try to register again.";
			header('Location:/med-lab-reports/');
			return;
		}
    }
    else {
		unset($_SESSION['email']);
		unset($_SESSION['otp']);
		$_SESSION['error'] = 'Incorrect OTP. Please try again.';
        header('Location:/med-lab-reports/forgot-password.php');
		return;
    }
}
else {
	header('Location:/med-lab-reports/');
	return;
}
