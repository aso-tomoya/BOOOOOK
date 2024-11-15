<?php
#1件だけ取得
function get($db, $id)
{
    $sql = $db->prepare('SELECT * FROM item where item_id = ?');
    $sql->execute([$id]);
    return $sql->fetchAll(PDO::FETCH_ASSOC);
}

#ランキング用
function getRanking($db)
{
    $sql = $db->prepare('SELECT * FROM item ORDER BY salse_count DESC LIMIT 10');
    $sql->execute();
    return $sql->fetchAll(PDO::FETCH_ASSOC);  // 上位10件の商品情報を配列で返す
}

#ピックアップ用
function getPickup($userId, $db)
{
    if ($userId) {
        // ユーザーの注文履歴から商品IDを取得
        $query = "SELECT item_id FROM orders WHERE user_id = ?";
        $sql = $db->prepare($query);
        $sql->execute([$userId]);
        $orderedItemIds = $sql->fetchAll(PDO::FETCH_COLUMN);

        // 注文済み商品ID以外の商品をランダムで取得
        if (!empty($orderedItemIds)) {
            $placeholders = implode(',', array_fill(0, count($orderedItemIds), '?'));
            $query = "SELECT * FROM item WHERE item_id NOT IN ($placeholders) ORDER BY RAND() LIMIT 30";
            $sql = $db->prepare($query);
            $sql->execute($orderedItemIds);
        } else {
            // 注文履歴がない場合、全商品からランダムで取得
            $query = "SELECT * FROM item ORDER BY RAND() LIMIT 30";
            $sql = $db->prepare($query);
            $sql->execute();
        }
    } else {
        // ユーザーIDが存在しない場合、全商品からランダムで取得
        $query = "SELECT * FROM item ORDER BY RAND() LIMIT 30";
        $sql = $db->query($query);
    }

    return $sql->fetchAll(PDO::FETCH_ASSOC);
}
