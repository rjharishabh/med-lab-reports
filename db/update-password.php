<?php
session_start();

if(isset($_POST['newpass']) && isset($_POST['confpass'])) {

	if($_POST['newpass'] === $_POST['confpass']) {

		require 'connect_db.php';

		$salt='salt';

		$sql='UPDATE auth SET password=:pass WHERE email=:email';
		$query=$db->prepare($sql);
		$query->execute(array(
			':pass'=>hash('sha256',$_POST['newpass'] . $salt),
			':email'=>$_SESSION['email']
		));

		$_SESSION['success'] = "Password successfully changed. <br>Please login with the new password.";
		unset($_SESSION['email']);
		header('Location:/medical-test-and-report-management-system/');
		return;
	}
	else {
		$_SESSION['error'] = "Password and confirm password should be same <br>Please try again.";
		header('Location:/medical-test-and-report-management-system/change-password.php');
		return;
	}

} else {
	header('Location:/medical-test-and-report-management-system/');
	return;
}

?>
