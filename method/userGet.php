<?php
// ログイン中のユーザー情報をすべて取得
function getUser($db, $id)
{
    $sql = $db->prepare('SELECT * FROM user where user_id = ?');
    $sql->execute([$id]);
    return $sql->fetch(PDO::FETCH_ASSOC);
}

// ユーザーの支払情報取得
function getPay($db, $id){
    $sql = $db->prepare('SELECT * FROM payment_info where pay_id = ?');
    $sql->execute([$id]);
    return $sql->fetch(PDO::FETCH_ASSOC);
}

// ユーザーの注文履歴取得
function getOrder($db, $id){
    $sql = $db->prepare('SELECT * FROM order_detail where user_id = ? order by purchase_date desc');
    $sql->execute([$id]);
    return $sql->fetchAll(PDO::FETCH_ASSOC);
}