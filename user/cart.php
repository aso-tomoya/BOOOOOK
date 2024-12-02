<?php
session_start();
session_destroy();

// ヘッダー呼び出し
include_once('../header.php');

// カート情報をセッションから取得
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

// 数量を計算
$item_cnt = array_count_values($cart);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>BOOOOOK-カート一覧</title>
</head>
<body>

<!-- メソッドファイル呼び出し -->
<?php include_once('../method/itemGet.php') ?>

<main class="cart-container">
    <h1 class="cart-title">カート一覧</h1>
    <div class="cart-content">
        <!-- 左側: ショッピングカート -->
        <div class="cart-left">
            <h2>ショッピングカート</h2>

            <?php if (count($item_cnt) > 0): ?>
                <?php
                $subtotal = 0;
                foreach ($item_cnt as $item_id => $quantity):
                    $item = get($db, $item_id); // 商品情報取得
                    $item_total = $item['item_price'] * $quantity; // 商品合計
                    $subtotal += $item_total; // 小計に加算
                ?>
                    <div class="cart-item">
                        <img src="../img/<?= $item['item_img']; ?>" alt="<?= $item['item_name']; ?>" class="cart-item-image">
                        <div class="cart-item-details">
                            <p class="cart-item-title"><?= $item['item_name']; ?></p>
                            <p class="cart-item-price">価格: ¥<?= number_format($item['item_price']); ?></p>
                            <p class="cart-item-quantity">数量: <?= $quantity; ?></p>
                            <a href="../method/remove_from_cart.php?item_id=<?= $item_id; ?>" class="cart-item-remove">削除</a>
                        </div>
                    </div>
                <?php endforeach; ?>

                <hr>
                <p class="cart-subtotal">カート内小計: ¥<?= number_format($subtotal); ?></p>
            <?php else: ?>
                <p>カートに商品がありません。</p>
            <?php endif; ?>
        </div>

        <!-- 右側: 合計金額 -->
        <div class="cart-right">
            <h2>合計金額（税込）</h2>
            <p class="cart-total">¥<?= number_format($subtotal ?? 0); ?></p>
            <hr>
            <a href="checkout.php" class="cart-checkout-button">購入画面に進む</a>
        </div>
    </div>
</main>

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
</body>
</html>
