<?php
session_start();

require 'connect_db.php';

if (isset($_GET['email'])) {
	$email = $_REQUEST['email'];
}
else if (isset($_POST['email'])) {
	$email = $_POST['email'];
}

$esql = 'SELECT * FROM auth WHERE email=:email';
$e = $db->prepare($esql);
$e->execute(array(':email'=>$email));
$row = $e->fetch(PDO::FETCH_ASSOC);

if (isset($_GET['email'])) {
	if ($row === false) {
		$otp = '';
		for($i=0; $i<6; $i++) {
			$otp = $otp . mt_rand(0,9);
		}

		$_SESSION['otp'] = $otp;

		require 'email.php';

		$res = email($email, '', '', 1, $otp);
		echo $res;

		$_SESSION['email'] = $email;
	}
	else {
		$_SESSION['error'] = "Email already exists <br>Please register with different email.";
	    echo 'Email already exists';
	}
}
else if (isset($_POST['password']) && isset($_POST['confpassword'])
	&& isset($_POST['email']) && isset($_POST['otp'])) {
		if ($row === false) {
			if ($_POST['email'] === $_SESSION['email']) {
				if ($_POST['otp'] === $_SESSION['otp']) {
					if ($_POST['password'] === $_POST['confpassword']) {
						$salt = 'salt';
						$sql = 'INSERT INTO auth(email,password) VALUES(:email,:password)';
						$reg = $db->prepare($sql);
						$p = $reg->execute(array(':email'=>$_POST['email'],
						':password'=>hash('sha256',$_POST['password'].$salt)
					));

					$_SESSION['authid'] = $db->lastInsertId();

					$sql = 'INSERT INTO users (uid) VALUES(:uid)';
					$query = $db->prepare($sql);
					$query->execute(array(':uid'=>$_SESSION['authid']));

					$_SESSION['success'] = "Please complete your profile";
					header('Location:/med-lab-reports/edit-profile.php');
					return;
				}
				else {
					unset($_SESSION['otp']);
					unset($_SESSION['email']);
					$_SESSION['error'] = "Password and confirm password should be same. <br>Please try to register again.";
					header('Location:/med-lab-reports/');
					return;
				}
			}
			else {
				unset($_SESSION['otp']);
				unset($_SESSION['email']);
				$_SESSION['error'] = "OTP is not correct. <br>Please try to register again.";
				header('Location:/med-lab-reports/');
				return;
			}
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
		unset($_SESSION['otp']);
		unset($_SESSION['email']);
		$_SESSION['error'] = "Email already exists. <br>Please register with different email.";
		header('Location:/med-lab-reports/');
		return;
	}
}
