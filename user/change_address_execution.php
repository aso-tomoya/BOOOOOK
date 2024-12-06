<?php
session_start();

$pdo=new PDO('mysql:host=mysql311.phy.lolipop.lan;
            dbname=LAA1557203-boooook;charset=utf8',
            'LAA1557203',
            'boooook');

$name = $_POST['name'];
$postcode = mb_convert_kana($_POST['postcord'], 'an');
$address = $_POST['address'];

// チェックボックスにチェックがない場合（セッションに保存）
if(!isset($_POST['check'])){
    $_SESSION['name'] = $name;
    $_SESSION['postcode'] = $postcode;
    $_SESSION['address'] = $address;
}else{
    $id = $_SESSION['user_id'];
    $sql = $pdo->prepare('UPDATE user SET postal_code=?, address=? WHERE user_id = ?');
    $sql->execute([$postcode,$address,$_SESSION['user_id']]);
    $pdo = null;
}

header('Location: '.$_POST['url']);
exit()
?>