<?php
session_start();

require 'connect_db.php';

$email_sql = 'SELECT * FROM auth WHERE email=:email';
$email = $db->prepare($email_sql);
$email->execute(array(':email'=>$_POST['email']));
$row = $email->fetch(PDO::FETCH_ASSOC);

if($row === false){

    if ($_POST['password'] === $_POST['confpassword']) {
        $salt = 'salt';
        $sql = 'INSERT INTO auth(email,password) VALUES(:email,:password)';
        $reg = $db->prepare($sql);
        $p = $reg->execute(array(':email'=>$_POST['email'],
        ':password'=>hash('sha256',$_POST['password'].$salt)
        ));

        $sql = 'SELECT * FROM auth WHERE email=:email AND password=:password';
        $login = $db->prepare($sql);
        $login->execute(array(
            ':email'=>$_POST['email'],
            ':password'=>hash('sha256',$_POST['password'].$salt)
        ));

        $row = $login->fetch(PDO::FETCH_ASSOC);

        $_SESSION['authid'] = $row['id'];

		$sql = 'INSERT INTO users (uid) VALUES(:uid)';
		$query = $db->prepare($sql);
		$query->execute(array(':uid'=>$_SESSION['authid']));

		$_SESSION['success'] = "Please complete your profile";
		header('Location:/medical-test-and-report-management-system/edit-profile.php');
		return;
    }
    else {
        $_SESSION['error'] = "Password and confirm password should be same <br>Please try to register again.";
        header('Location:/medical-test-and-report-management-system/');
        return;
    }
}
else {
    $_SESSION['error'] = "Email already exists <br>Please register with different email.";
    header('Location:/medical-test-and-report-management-system/');
    return;
}
