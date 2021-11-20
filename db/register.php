<?php
require 'connect_db.php';

$email_sql='SELECT * FROM users WHERE email=:email';
$email=$db->prepare($email_sql);
$email->execute(array(':email'=>$_POST['email']));

$row=$email->fetch(PDO::FETCH_ASSOC);

if($row===false){

    if ($_POST['password']===$_POST['confpassword']) {
        $salt='salt';
        $sql='INSERT INTO users(email,password,token) VALUES(:email,:password,:token)';
        $reg=$db->prepare($sql);
        $reg->execute(array(':email'=>$_POST['email'],
        ':password'=>hash('sha1',$_POST['password'].$salt),
        ':token'=>md5(uniqid())
        ));
    }
    else {
        echo "Password and confirm password should be same";
    }
}
else {
        echo "Email already exists";
}
