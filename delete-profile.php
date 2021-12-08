<?php
session_start();

if (!isset($_SESSION['authid'])) {
	header('Location:/medical-test-and-report-management-system/');
	return;
}

require 'db/connect_db.php';

$sql='DELETE FROM auth WHERE id=:id';
$query=$db->prepare($sql);
$query->execute(array(':id'=>$_SESSION['authid']));

unset($_SESSION['authid']);

$_SESSION['success'] = "Profile deleted successfully.";
header('Location:/medical-test-and-report-management-system/');
return;

?>
