<?php
function checkout($db, $itemId, $user, $itemPrice, $detailId){
    // 購入情報登録
    $sql = $db->prepare('INSERT INTO order_detail(user_id, detail_id, item_id, pay_id, purchase_date) value(?,?,?,?,?)');
    $sql->execute([$user['user_id'], $detailId, $itemId, $user['pay_id'], date('Y-m-d')]);

    // ユーザーの合計金額更新
    $sql = $db->prepare('SELECT total_price FROM user WHERE user_id = ?');
    $sql->execute([$user['user_id']]);

    $price = $sql->fetch(PDO::FETCH_ASSOC)['total_price'];
    $price += $itemPrice;
    $sql = $db->prepare('UPDATE user SET total_price = ? WHERE user_id = ?');
    $sql->execute([$price, $user['user_id']]);

    // 商品の売上数更新
    $sql = $db->prepare('SELECT sales_count FROM item WHERE item_id = ?');
    $sql->execute([$itemId]);

    $count = $sql->fetch(PDO::FETCH_ASSOC)['sales_count'];
    $count += 1;
    $sql = $db->prepare('UPDATE item SET sales_count = ? WHERE item_id = ?');
    $sql->execute([$count, $itemId]);
}

function checkoutInfo($db, $user){
    $sql = $db->prepare('INSERT INTO detail_info(detail_postal, detail_address, detail_name) VALUE(?,?,?)');
    $sql->execute([$user['postal_code'], $user['address'], $user['name']]);

    return $db->lastInsertId();
}