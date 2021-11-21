<?php
session_start();

require 'connect_db.php';

$email_sql='SELECT * FROM auth WHERE email=:email';
$email=$db->prepare($email_sql);
$email->execute(array(':email'=>$_POST['email']));

$row=$email->fetch(PDO::FETCH_ASSOC);

if($row===false){

    if ($_POST['password']===$_POST['confpassword']) {
        $salt='salt';
        $sql='INSERT INTO auth(email,password,token) VALUES(:email,:password,:token)';
        $reg=$db->prepare($sql);
        $p=$reg->execute(array(':email'=>$_POST['email'],
        ':password'=>hash('sha256',$_POST['password'].$salt),
        ':token'=>hash('sha256',uniqid())
        ));

        $sql='SELECT * FROM auth WHERE email=:email AND password=:password';
        $login=$db->prepare($sql);
        $login->execute(array(
            ':email'=>$_POST['email'],
            ':password'=>hash('sha256',$_POST['password'].$salt)
        ));

        $row=$login->fetch(PDO::FETCH_ASSOC);

        $obj=(object)['id'=>$row['id'],'token'=>$row['token']];
        $json=json_encode($obj);
        setcookie('login',$json);

        header('Location:/medical-test-and-report-management-system/dashboard.php');
    }
    else {
        echo "Password and confirm password should be same";
    }
}
else {
        echo "Email already exists";
}
