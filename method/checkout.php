<?php
function checkout($db, $itemId, $userId, $paymentId , $itemPrice){
    $sql = $db->prepare('INSERT INTO order_detail(user_id,item_id, pay_id, purchase_date) value(?,?,?,?)');
    $sql->execute([$userId, $itemId, $paymentId, date('Y-m-d')]);

    $sql = $db->prepare('SELECT total_price FROM user WHERE user_id = ?');
    $sql->execute([$userId]);

    $price = $sql->fetch(PDO::FETCH_ASSOC)['total_price'];
    $price += $itemPrice;
    $sql = $db->prepare('UPDATE user SET total_price = ? WHERE user_id = ?');
    $sql->execute([$price, $userId]);
}