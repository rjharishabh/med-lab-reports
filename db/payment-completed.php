<?php
session_start();

if (!isset($_POST['tid'])) {
	header('Location:/medical-test-and-report-management-system/dashboard.php');
	return;
}

require_once 'connect_db.php';
require_once 'tests_result.php';

$tid = intval($_POST['tid']);
$result = test_results($tid);

$sql = 'INSERT INTO tests_conducted (user_id, test_id, date_and_time, results) VALUES (:userid, :testid, :date_time, :result)';
$query = $db->prepare($sql);
$query->execute(array(
	':userid' => $_SESSION['authid'],
	':testid' => $tid,
	':date_time' => date('Y-m-d h:i:s'),
	':result' => $result
));

$_SESSION['tid'] = $tid;
header('Location:../invoice.php');
return;

?>
