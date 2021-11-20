<?php
require 'connect_db.php';

$sql='SELECT * FROM users WHERE email=:email AND password=:password';
$login=$db->prepare($sql);
$login->execute(array(
    ':email'=>$_POST['email'],
    ':password'=>hash('sha1',$_POST['password'].'salt')
));

$row=$login->fetch(PDO::FETCH_ASSOC);

if ($row===false) {
    echo "Incorrect Username or Password";
}
else {
    $obj=(object)['id'=>$row['id'],'token'=>$row['token']];
    $json=json_encode($obj);
    setcookie('login',$json);
}
