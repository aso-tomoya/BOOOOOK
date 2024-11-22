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
    dbname=LAA1557217-boooook;charset=utf8',
    'LAA1557217',
    'boooook');

    $name=$_POST['name'];
    $mail=$_POST['mail'];
    $postcord=$_POST['postcord'];
    $address=$_POST['address'];

    $sql=$pdo->prepare('UPDATE user SET name=?,mail=?,postcord=?,address=?');
    $result=$sql->execute([$name,$mail,$postcord,$address]);
    $pdo=null;
    if($result){
        header('Location: mypage.php');
        exit();
    }else{
        header('Location: edit_profile.php');
        exit();
    }
    ?>
</body>
</html>