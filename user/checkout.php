<?php
session_start();
if(isset($_SESSION['url'])){
    unset($_SESSION['url']);
}

// ヘッダー呼び出し
include_once('../header.php');
include_once('../method/userGet.php');

// カート情報をセッションから取得
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
// ユーザー情報取得
$user = getUser($db, $_SESSION['user_id']);
// 支払情報取得
$payInfo = getPay($db, $user['pay_id']);

// セッションに変更後の配送情報があるか確認
$name = $_SESSION['name'] ?? $user['name'];
$postCode = $_SESSION['postCode'] ?? $user['postal_code'];
$address = $_SESSION['address'] ?? $user['address'];

// 数量を計算
$item_cnt = array_count_values($cart);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>BOOOOOK-購入画面</title>
</head>
<body>

<!-- メソッドファイル呼び出し -->
<?php include_once('../method/itemGet.php') ?>

<main class="cart-container">
    <h1 class="cart-title">購入画面</h1>
    <div class="cart-content">
        <!-- 左側: 配送情報 -->
        <div class="cart-left">

            <h2>配送情報</h2>
            <ul>
                <li>お名前：<?=$name?></li>
                <li>郵便番号：<?=$postCode?></li>
                <li>住所：<?=$address?></li>
            </ul>
            <a href="change_address.php">変更</a>

            <hr>

            <h2>支払い方法</h2>
            <?php if(empty($payInfo)):?>
                <ul>
                    <li>登録されていません</li>
                </ul>
            <?php else: ?>
            <ul>
                <li>カード番号：****-****-****-<?=substr($payInfo['card_number'],-4)?></li>
                <li>有効期限：<?=$payInfo['validity_period']?></li>
                <li>カード名義：<?=$payInfo['card_name']?></li>
            </ul>
            <?php endif ?>
            <a href="manage_payment.php">支払方法を管理</a>

            <hr>

            <h2>注文概要</h2>
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
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>


        <div class="cart-right">
            <?php if(empty($payInfo)): ?>
                <a href="manage_payment.php" class="button2">支払方法を登録してください</a>
            <?php else: ?>
            <a href="order_complete.php" class="cart-checkout-button">注文を確定する</a><hr>
            <?php endif; ?>
            <p class="cart-subtotal">小計: ¥<?= number_format($subtotal); ?></p>
            <p class="cart-subtotal">送料: ¥200</p><hr>
            <p class="cart-total">合計: ¥<?= number_format($subtotal + 200); ?></p>
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
