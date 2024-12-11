<?php
$pdo = new PDO(
    'mysql:host=mysql311.phy.lolipop.lan;
        dbname=LAA1557203-boooook;charset=utf8',
    'LAA1557203',
    'boooook'
);
// その商品の注文履歴の商品IDをnullにする
$sql = $pdo->prepare('UPDATE order_detail SET item_id = null WHERE item_id = ?');
$sql->execute([$_POST['item_id']]);

$sql = $pdo->prepare('DELETE FROM item WHERE item_id = ?');
$sql->execute([$_POST['item_id']]);

header('Location: manage_products.php');