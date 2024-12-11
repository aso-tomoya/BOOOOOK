<?php
session_start();

include_once('../header.php');
include_once('../method/userGet.php');
include_once('../method/itemGet.php');

// 注文詳細を取得
$order = getDetail($db, $_GET['id']);
$item = get($db, $order['item_id']);
$user = getUser($db, $_SESSION['user_id']);
$pay = getPay($db, $order['pay_id']);

if($order['detail_id']){
    $info = getInfo($db, $order['detail_id']);
    $user['name'] = $info['detail_name'];
    $user['postal_code'] = $info['detail_postal'];
    $user['address'] = $info['detail_address'];
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>BOOOOOK - 注文履歴</title>
</head>
<body>

    <main class="detail-container">
        <h1>注文詳細</h1>
        <div class="product-detail">
            <div class="detail-image">
                <img src="../img/<?=$item['item_img']?>" alt="商品画像" class="detail-product-image">
                <div class="detail-product-info">
                    <h3><?= $item['item_name'] ?></h3>
                    <p>価格: ¥<?= number_format($item['item_price']) ?></p>
                </div>
            </div>
            
        <div class="product-info">
            <div class="customer-details">
                <h3>お名前</h3>
                <p><?=$user['name']?></p>
                <h3>郵便番号</h3>
                <p><?=$user['postal_code']?></p>
                <h3>住所</h3>
                <p><?=$user['address']?></p>
                <h3>支払い方法</h3>
                <p>カード番号: ****-****-****-<?= substr($pay['card_number'],-4) ?></p>
                <h3>注文日</h3>
                <p><?= date('Y年m月d日', strtotime($order['purchase_date'])) ?></p>
            </div>
        </div>
        </div>
        <a href="mypage.php" class="detail-button">マイページに戻る</a>
    </main>

    <script src="../script/script.js"></script>
</body>
</html>
