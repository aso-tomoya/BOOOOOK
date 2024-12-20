<?php
session_start();
// session_destroy();

// ヘッダー呼び出し
include_once('../header.php');
include_once('../method/userGet.php');
?>


<!-- 完成 -->


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>BOOOOOK-トップ</title>

</head>
<body>

<!-- メソッドファイル呼び出し -->
<?php include_once ('../method/itemGet.php'); ?>

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
                $itemName = $item['item_name'];
                $itemPrice = number_format($item['item_price']);  // 価格をカンマ区切りに
                $itemImg = $item['item_img'];

                $imgClass = $rank <= 3 ? 'img-top-3' : 'img';

                echo '<div class="item" onclick="goToItemPage('.$item['item_id'].')">';
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
    </fieldset>
</div>

<div id="back-to-top" class="back-to-top">
    ↑
</div>

<script src="../script/script.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    const backToTopButton = document.getElementById('back-to-top');

    // スクロールイベントの設定
    window.addEventListener('scroll', function() {
        if (window.scrollY > 300) { // スクロールが300pxを超えた場合
            backToTopButton.classList.add('show');
        } else {
            backToTopButton.classList.remove('show');
        }
    });

    // クリックイベントでページトップにスクロール
    backToTopButton.addEventListener('click', function() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
});
</script>
<?php
if(isset($_GET['login'])){
    echo '<script>
            window.onload = function() {
            alert("ログインに成功しました。\nようこそ、'.getUser($db,$_SESSION['user_id'])['name'].'さん！");
            };
        </script>';
}
?>
</body>
</html>