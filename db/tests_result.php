<?php

function test_results($tid) {
	switch ($tid) {
		case 1:
			$value = mt_rand(65,160);
			break;
		case 2:
			$value = mt_rand(65,200);
			break;
		case 3:
			$value = mt_rand(50,190)/100;
			break;
		case 4:
			$value = mt_rand(1000,2000)/100;
			break;
		case 5:
			$value = mt_rand(400,600)/100;
			break;
		case 6:
			$value = mt_rand(3500,5500)/100;
			break;
		case 7:
			$value = mt_rand(350,1100)/100;
			break;
		case 8:
			$value = mt_rand(1100,1500)/100;
			break;
		case 9:
			$value = mt_rand(8100,10300)/100;
			break;
		case 10:
			$value = mt_rand(2500,3500)/100;
			break;
		case 11:
			$value = mt_rand(3000,3600)/100;
			break;
		case 12:
			$value = mt_rand(10000,42000)/100;
			break;
		case 13:
			$value = mt_rand(15000,20500)/100;
			break;
		case 14:
			$value = mt_rand(3500,4500)/100;
			break;
		case 15:
			$value = mt_rand(7000,10500)/100;
			break;
		default:
			$value='Unable to calculate test result';
			break;
		}
		return $value;
}

?>
