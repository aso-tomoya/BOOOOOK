<?php
#1件だけ取得
function get($db, $id)
{
    $sql = $db->prepare('SELECT * FROM item where item_id = ?');
    $sql->execute([$id]);
    return $sql->fetch(PDO::FETCH_ASSOC);
}

#全ジャンル取得
function getAllGenre($db){
    $sql = $db->query('SELECT * FROM genre ');
    return $sql->fetchAll(PDO::FETCH_ASSOC);
}

#ジャンル名取得
function getGenre($db, $id){
    $sql = $db->prepare('SELECT genre_name FROM genre where genre_id = ?');
    $sql->execute([$id]);
    return $sql->fetch(PDO::FETCH_ASSOC);
}

#ランキング用
function getRanking($db)
{
    $sql = $db->prepare('SELECT * FROM item ORDER BY sales_count DESC LIMIT 10');
    $sql->execute();
    return $sql->fetchAll(PDO::FETCH_ASSOC);  // 上位10件の商品情報を配列で返す
}

#ピックアップ用
function getPickup($userId, $db)
{
    if ($userId) {
        // ユーザーの注文履歴から商品IDを取得
        $query = "SELECT item_id FROM order_detail WHERE user_id = ?";
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


#商品を検索ワードで検索
function itemSearch($db, $word, $sortBy) {
    // 検索ワードが空でない場合のみ処理を実行
    if (!empty($word)) {
        // 並べ替え条件を動的に構築
        $orderBy = '';
        switch ($sortBy) {
            case 'sales_desc': // 売上個数の多い順
                $orderBy = 'sales_count DESC';
                break;
            case 'price_desc': // 価格の高い順
                $orderBy = 'item_price DESC';
                break;
            case 'price_asc': // 価格の低い順
                $orderBy = 'item_price ASC';
                break;
            case 'alphabetical': // 50音順 (商品名の昇順)
                $orderBy = 'item_name ASC';
                break;
            default: // デフォルトでは人気順
                $orderBy = 'sales_count DESC';
        }

        // 商品名(item_name)または著者名(author)に対してLIKE検索を使用
        $query = "SELECT * FROM item WHERE item_name LIKE ? OR author LIKE ? ORDER BY ".$orderBy;
        $sql = $db->prepare($query);

        // 検索ワードを前後にワイルドカード（%）を付けて部分一致検索
        $searchTerm = "%" . $word . "%";
        $sql->execute([$searchTerm, $searchTerm]);

        // 検索結果を返す
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    } else {
        // ワードが空の場合は全商品表示
        $sql = $db->query('SELECT * FROM item');
        return $sql->fetchAll(PDO::FETCH_ASSOC);
    }
}

// 商品をジャンルIDで検索
function itemSearchByGenre($db, $id, $sortBy) {
    // 並べ替え条件を動的に構築
    $orderBy = '';
    switch ($sortBy) {
        case 'sales_desc': // 売上個数の多い順
            $orderBy = 'sales_count DESC';
            break;
        case 'price_desc': // 価格の高い順
            $orderBy = 'item_price DESC';
            break;
        case 'price_asc': // 価格の低い順
            $orderBy = 'item_price ASC';
            break;
        case 'alphabetical': // 50音順 (商品名の昇順)
            $orderBy = 'item_name ASC';
            break;
        default: // デフォルトでは人気順
            $orderBy = 'sales_count DESC';
    }

    // ジャンルで検索
    $query = "SELECT * FROM item WHERE genre_id = ? ORDER BY ".$orderBy;
    $sql = $db->prepare($query);
    $sql->execute([$id]);

    // 検索結果を返す
    return $sql->fetchAll(PDO::FETCH_ASSOC);
}