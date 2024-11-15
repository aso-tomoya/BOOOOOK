<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>トップ</title>

</head>
<body>

<!-- ヘッダー呼び出し -->
<?php include ('../header.php'); ?>
<!-- メソッドファイル呼び出し -->
<?php include ('../method/itemGet.php'); ?>

<!-- ランキング -->
<div class="container">
    <div class="ranking">
        <h2>ランキング</h2>
        
        <div class="item-list">

            <?php
            $rankingItems = getRanking($db);  // ランキング情報を取得

            // 順位をカウントする変数
            $rank = 1;
            foreach ($rankingItems as $item) {
                // 商品情報を取得
                $itemName = htmlspecialchars($item['item_name'], ENT_QUOTES, 'UTF-8');
                $itemPrice = number_format($item['item_price']);  // 価格をカンマ区切りに
                $itemImg = htmlspecialchars($item['item_img'], ENT_QUOTES, 'UTF-8');

                $imgClass = $rank <= 3 ? 'img-top-3' : 'img';

                echo '<div class="item">';
                echo '<div class="rank">' . $rank . '位</div>';  // 順位表示
                echo '<img src="../img/'.$itemImg.'" alt="'.$itemName.'" class="'.$imgClass.'">';  // 商品画像
                echo '<div class="title">' . $itemName . '</div>';  // 商品名
                echo '<div class="price">¥' . $itemPrice . '</div>';  // 価格
                echo '</div>';

                // 順位を次に進める
                $rank++;
            }

            ?>

        </div>
    </div>
</div>

<!-- ピックアップ -->
<div class="container">
    <fieldset disabled="disabled">
        <div class="pickup">
            <h2>ピックアップ</h2>
            <div class="item-list">
                
                <?php

                $userId = $_SESSION['user_id'] ?? null;
                $pickupItems = getPickup($userId, $db);


                foreach ($pickupItems as $item) {
                    // 商品情報を取得
                    $itemName = htmlspecialchars($item['item_name'], ENT_QUOTES, 'UTF-8');
                    $itemPrice = number_format($item['item_price']);  // 価格をカンマ区切りに
                    $itemImg = htmlspecialchars($item['item_img'], ENT_QUOTES, 'UTF-8');
                
                    echo '<div class="item">';
                    echo '<img src="../img/'.$itemImg.'" alt="'.$itemName.'" class="img">';  // 商品画像
                    echo '<div class="title">' . $itemName . '</div>';  // 商品名
                    echo '<div class="price">¥' . $itemPrice . '</div>';  // 価格
                    echo '</div>';
                }
                
                ?>
                
            </div>
        </div>
    </fieldset>
</div>

<script src="../script/script.js"></script>
</body>
</html>