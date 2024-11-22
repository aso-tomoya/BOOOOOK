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
    $mail=$_POST['mail'];
    $password1=$_POST['password1'];
    $password2=$_POST['password2'];
    $postcord=$_POST['postcord'];
    $address=$_POST['address'];

    var_dump($_POST);

    if (empty($name) || empty($mail) || empty($password1) || empty($password2) || empty($postcode) || empty($address)) {
        header('Location: register.php?error=1');
        exit();
    }
    if ($password1 !== $password2) {
        header('Location: register.php?error=2');
        exit();
    }
    $pdo=new PDO('mysql:host=mysql311.phy.lolipop.lan;
    dbname=LAA1557203-boooook;charset=utf8',
    'LAA1557203',
    'boooook');

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql=$pdo->prepare('INSERT INTO user(name,mail,password1,postcord,address)VALUES(?,?,?,?,?)');
    $sql->execute([$name,$mail,$password1,$postcord,$address]);
    $pdo=null;
    header('Location: login.php');
        exit();
    ob_end_flush();
    ?>
</body>
</html>