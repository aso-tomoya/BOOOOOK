<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    ob_start();
    
    $name=$_POST['name'];
    $mail_address=$_POST['mail_address'];
    $user_pass=$_POST['user_pass'];
    $confirm_pass=$_POST['confirm_pass'];
    $postal_code=$_POST['postal_code'];
    $address=$_POST['address'];

    var_dump($_POST);

    if (empty($name) || empty($mail_address) || empty($user_pass) || empty($confirm_pass) || empty($postal_code) || empty($address)) {
        header('Location: register.php?error=1');
        exit();
    }
    if ($user_pass !== $confirm_pass) {
        header('Location: register.php?error=2');
        exit();
    }
    $pdo=new PDO('mysql:host=mysql311.phy.lolipop.lan;
    dbname=LAA1557203-boooook;charset=utf8',
    'LAA1557203',
    'boooook');

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql=$pdo->prepare('INSERT INTO user(name,mail_address,user_pass,postal_code,address)VALUES(?,?,?,?,?)');
    $sql->execute([$name,$mail_address,$user_pass,$postal_code,$address]);
    $pdo=null;
    header('Location: login.php');
        exit();
    ob_end_flush();
    ?>
</body>
</html>