<?php
session_start();

include_once('../header.php');
include_once('../method/userGet.php');
include_once('../method/itemGet.php');

// ユーザー情報取得
$user = getUser($db, $_SESSION['user_id']);
$uname = $user['name'];
$umail = $user['mail_address'];
$upost = $user['postal_code'];
$uaddress = $user['address'];
$upay = getPay($db, $user['pay_id']);

// 注文履歴取得
$orders = getOrder($db, $_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">    
    <title>BOOOOOK-マイページ</title>

</head>
<body>



<main class="mypage-container">
    <section class="user-info">
        <div class="user-icon">👤</div>
        <h2><?=$uname?>様</h2>
        <ul class="user-details">

            <li>名前：<br>　<?=$uname?></li>

            <li>メールアドレス：<br>　<?=$umail?></li>

            <li>郵便番号：<br>　<?=$upost?></li>
            
            <li>住所：<br>　<?=$uaddress?></li>
            <li><a href="edit_profile.php">変更</a></li>

            <li>現在の支払い方法：<br>　
                <?php if(!$upay):?>
                    登録されていません。
                <?php else:?>
                    ****-****-****-<?=substr($upay['card_number'],-4)?>
                <?php endif?>
            </li>
            <li><a href="manage_payment.php">支払い方法管理</a></li>
        </ul>
        <a href="logout.php"><button class="logout-button">ログアウト</button></a>
    </section>

    <section class="purchase-history">
        <h2>購入履歴</h2>
        <div class="history-grid">
            <?php if(count($orders) > 0): ?>

                <?php foreach($orders as $order): ?>
                    <?php $item = get($db, $order['item_id']); ?>

                    <div class="history-item" onclick="goToDetailPage(<?=$order['order_id']?>)">
                        <div class="item-thumbnail">
                            <img src="../img/<?=$item['item_img']?>" alt="<?=$item['item_name']?>" class="item-thumbnail">
                            <?=$item['item_name']?>
                        </div>
                        <div class="price">￥<?=number_format($item['item_price'])?></div>
                        <div class="date">注文日: <?=$order['purchase_date']?></div>
                    </div>

                <?php endforeach ?>
                    <div class="total-price">合計：<?=number_format($user['total_price'])?>円</div>
            <?php else: ?>
                <h1>まだ商品が購入されていません</h1>
            <?php endif ?>
        </div>
    </section>
</main>

<script>
function goToDetailPage(orderId){
    window.location.href = `order_details.php?id=${orderId}`;
}
</script>

</body>
</html>
