<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
<?php
    $pdo=new PDO('mysql:host=mysql311.phy.lolipop.lan;
    dbname=LAA1557203-boooook;charset=utf8',
    'LAA1557203',
    'boooook');

    $name=$_POST['name'];
    $mail=$_POST['mail_address'];
    $postcord=$_POST['postal_code'];
    $address=$_POST['address'];

    $sql=$pdo->prepare('UPDATE user SET name=?,mail_address=?,postal_code=?,address=?');
    $result=$sql->execute([$name,$mail_address,$postal_code,$address]);
    $pdo=null;
    header('Location: mypage.php');
    exit();

?>