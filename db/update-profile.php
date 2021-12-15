<?php
session_start();

if (!isset($_POST['name'])) {
	header('Location:/medical-test-and-report-management-system/dashboard.php');
	return;
}

require_once 'connect_db.php';

$age=0;

if ($_POST['dob'] !== '') {
	$year = explode('-',$_POST['dob']);
	$age = date('Y') - $year[0];
}

$sql = "UPDATE users SET name=:name, dob=:dob, age=:age, gender=:gender, mobile=:mobile, address=:address WHERE uid=:uid";
$query = $db->prepare($sql);
$query->execute(array(
	':name'=>$_POST['name'],
	':dob'=>$_POST['dob'],
	':age'=>$age,
	':gender'=>$_POST['gender'],
	':mobile'=>$_POST['mobile'],
	':address'=>trim($_POST['address']),
	':uid'=>$_SESSION['authid']
));

header('Location:/medical-test-and-report-management-system/dashboard.php');
return;

?>