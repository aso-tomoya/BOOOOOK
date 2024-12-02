<?php
session_start();

// ヘッダー呼び出し
include_once ('../header.php');
// メソッドファイル呼び出し
include_once ('../method/itemGet.php');

$word = isset($_GET['searchWord']) ? $_GET['searchWord'] : $getGenre($db, $_GET['genre'])['genre_name'];
$items = itemSearch($db, $word);
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
    <p><?=count($items)?>件</p>
    <div class="sort-options">
        
        <select name="sortBy">
            <option value="sales_desc">人気順</option>
            <option value="price_desc">高い順</option>
            <option value="price_asc">安い順</option>
            <option value="alphabetical">50音順</option>
        </select>

    </div>
    <div class="container">
        <div class="search">
            <div class="item-list">
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