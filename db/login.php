<?php
session_start();

require 'connect_db.php';

$salt = 'salt';
$sql = 'SELECT * FROM auth WHERE email=:email AND password=:password';
$login = $db->prepare($sql);
$login->execute(array(
    ':email' => $_POST['email'],
    ':password' => hash('sha256', $_POST['password'].$salt)
));

$row = $login->fetch(PDO::FETCH_ASSOC);

if ($row === false) {
    $_SESSION['error'] = "Incorrect Email or Password";
    header('Location:/med-lab-reports/');
    return;
}
else {
	$_SESSION['authid'] = $row['id'];
    header('Location:/med-lab-reports/dashboard.php');
    return;
}
