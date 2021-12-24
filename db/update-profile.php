<?php
session_start();

if (!isset($_POST['name'])) {
	header('Location:/med-lab-reports/dashboard.php');
	return;
}

require 'connect_db.php';

$age=0;

if ($_POST['dob'] !== '') {
	$year = explode('-',$_POST['dob']);
	$age = date('Y') - $year[0];
	if ($age < 0) {
		$age = 0;
	}
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

header('Location:/med-lab-reports/dashboard.php');
return;

?>
