<?php
#1件だけ取得
function get($db,$id){
    $sql = $db->prepare('SELECT * FROM item where item_id = ?');
    $sql->execute([$id]);
    return $sql->fetchAll(PDO::FETCH_ASSOC);
}

#ランキング用
function ranking($db){
    $sql = $db->prepare('SELECT * FROM item ORDER BY salse_count DESC LIMIT 10');
    $sql->execute();
    return $sql->fetchAll(PDO::FETCH_ASSOC);  // 上位10件の商品情報を配列で返す
}
?>