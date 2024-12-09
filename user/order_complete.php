<?php
session_start();

include_once ('../header.php');
include_once ('../method/itemGet.php');
include_once ('../method/checkout.php');
include_once ('../method/userGet.php');
$error = false;
if(empty($_SESSION['cart'])){
    echo '<h1>予期せぬ遷移が行われました。</h1>';
    echo '<div class="button-container">
            <a href="index.php"><button class="button1">トップページへ戻る</button></a>
        </div>';
    $error = true;
}else{

    $user = getUser($db, $_SESSION['user_id']);

    $detailId = null;

    if(isset($_SESSION['name'])){
        $user['name'] = $_SESSION['name'];
        $user['postal_code'] = $_SESSION['postcode'];
        $user['address'] = $_SESSION['address'];
        $detailId = checkoutInfo($db, $user);
    }

    $cart = $_SESSION['cart'];
    foreach($cart as $itemId){
        $itemPrice = get($db, $itemId)['item_price'];
        checkout($db, $itemId, $user, $itemPrice, $detailId);
    }
    unset($_SESSION['cart']);
    unset($_SESSION['name']);
    unset($_SESSION['postcode']);
    unset($_SESSION['address']);
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>BOOOOOK-購入完了</title>
</head>
<body>
<?php if($error) exit; ?>
<div class="container">
    <div class="form-container">
        <h2 class="form-title">ご購入ありがとうございました！</h2>
        <h3>ご注文が正常に完了しました。</h3>
        <div class="button-container">
            <a href="index.php"><button class="button1">トップページへ戻る</button></a>
            <a href="mypage.php"><button class="button2">購入履歴を見る</button></a>
        </div>
    </div>
</div>

<script src="../script/script.js"></script>
</body>
</html>
