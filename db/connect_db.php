<?php
$db = new PDO('mysql:host=localhost;port=3306;dbname=medical_test','rishabh', 'rishabh');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

date_default_timezone_set('Asia/Kolkata');
