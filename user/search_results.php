<?php
session_start();

// ヘッダー呼び出し
include_once ('../header.php');
// メソッドファイル呼び出し
include_once ('../method/itemGet.php');

// 完成

// 検索ワード、検索ジャンルIDを取得
$word = isset($_GET['searchWord']) ? $_GET['searchWord'] : '' ;
$genre = '';
$genre = isset($_GET['genre']) ? $_GET['genre'] : '' ;

$sortBy = isset($_GET['sortBy']) ? $_GET['sortBy'] : 'sales_desc';
// 検索ワードか、検索ジャンルIDで検索
if(!empty($word)) $items = itemSearch($db, $word, $sortBy);
elseif($genre) {
    $items = itemSearchByGenre($db, $genre, $sortBy);
    $word = 'ジャンル：'.getGenre($db, $genre)['genre_name'];
}else{
    $items = itemGetAll($db, $sortBy);
    $word = '全て';
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>BOOOOOK-<?=$word?>の検索結果</title>
</head>
<body>


<div class="container">
    <h2>" <?=$word?> "の検索結果</h2>
    <?=count($items)?>件
    <div class="sort-options">
        表示：
        <select name="sortBy" id="sortBy" onchange="updateSort()">
            <option value="sales_desc" <?= $sortBy === 'sales_desc' ? 'selected' : '' ?>>人気順</option>
            <option value="price_desc" <?= $sortBy === 'price_desc' ? 'selected' : '' ?>>高い順</option>
            <option value="price_asc" <?= $sortBy === 'price_asc' ? 'selected' : '' ?>>安い順</option>
            <option value="alphabetical" <?= $sortBy === 'alphabetical' ? 'selected' : '' ?>>50音順</option>
        </select>
    </div>
    <div class="container">
        <div class="search">
            <div class="item-list" id="itemList">
                <?php
                
                foreach ($items as $item) {
                    // 商品情報を取得
                    $itemName = $item['item_name'];
                    $itemPrice = number_format($item['item_price']);  // 価格をカンマ区切りに
                    $itemImg = $item['item_img'];
                
                    echo '<div class="item" onclick="goToItemPage('.$item['item_id'].')">';
                    echo '<img src="../img/'.$itemImg.'" alt="'.$itemName.'" class="img">';  // 商品画像
                    echo '<div class="title">' . $itemName . '</div>';  // 商品名
                    echo '<div class="price">¥' . $itemPrice . '</div>';  // 価格
                    echo '</div>';
                }

                ?>
            </div>
        </div>
    </div>
</div>

<script src="../script/script.js"></script>
</body>
</html>