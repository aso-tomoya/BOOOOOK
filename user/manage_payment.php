<?php
session_start();

// ヘッダー呼び出し
include_once('../header.php');

// 遷移前のページURLを取得
if(!isset($_SESSION['url'])){
    if(strpos($_SERVER['HTTP_REFERER'], '/checkout.php')){
        $_SESSION['url'] = 'checkout.php';
    }else{
        $_SESSION['url'] = 'mypage.php';
    }
}

// 支払い方法を取得
$payments = getPayAll($db, $_SESSION['user_id']);
$user = getUser($db, $_SESSION['user_id']); // ユーザー情報を取得
$usingPayId = $user['pay_id']; // 現在使用中のカードID
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>BOOOOOK-支払い方法管理</title>
</head>
<body>

<!-- メソッドファイル呼び出し -->
<?php include_once('../method/itemGet.php') ?>

<main class="container">
    <div class="cart-content">
        <!-- 左側: 支払い方法の追加 -->
        <div class="form-container">
            <h2>支払い方法の追加</h2>
            <form action="manage_payment_execution.php" method="post" class="form">
                <div class="form-group">
                    <label for="card_number">カード番号</label>
                    <input type="text" id="card_number" name="cNumber" required placeholder="0000-0000-0000-0000" oninput="formatCardNumber(this)" maxlength="19">
                </div>
                <div class="form-group">
                    <label for="card_name">名義</label>
                    <input type="text" id="card_name" name="cName" required placeholder="BOOK TARO">
                </div>
                <div class="form-group">
                    <label for="expiry_date">有効期限</label>
                    <input type="text" id="expiry_date" name="expiryDate" required placeholder="mm/dd" oninput="formatExpiryDate(this)">
                </div>
                <div class="form-group">
                    <label for="security_code">セキュリティコード</label>
                    <input type="text" id="security_code" name="securityCode" required placeholder="000" maxlength="3">
                </div>
                <?php if(isset($_GET['error1'])):?>
                    <p style="color:red">同じカード番号が既に登録されています。</p>
                <?php endif ?>
                <button type="submit" class="button1" name="addNewCard">支払い方法を追加</button>
            </form>
        </div>

        <!-- 右側: 登録済みの支払い方法 -->
        <div class="payment-list-container">
            <h2>使用中のカード情報</h2>
            <?php if (isset($usingPayId)): ?>
                <?php
                $currentPayment = getPay($db, $usingPayId); // 現在使用中のカード情報を取得
                ?>
                <p>カード番号: **** **** **** <?= substr($currentPayment['card_number'], -4); ?></p>
                <p>有効期限: <?= $currentPayment['validity_period']; ?></p>
                <?php if (count($payments) > 1): ?>
                    <a href="manage_payment_execution.php?RemoveNumber=<?= $currentPayment['pay_id']; ?>" class="payment-remove">削除</a>
                <?php endif ?>
            <?php else: ?>
                <p>使用中のカードがありません。</p>
            <?php endif; ?>
            
            <h2>登録済みの支払い方法</h2>
            <?php if (count($payments) > 0): ?>
                <ul class="payment-list">
                    <?php foreach ($payments as $payment): ?>
                        <?php if ($payment['pay_id'] != $usingPayId): ?>
                            <li class="payment-item">
                                <div>
                                    <p>カード番号: **** **** **** <?= substr($payment['card_number'], -4); ?></p>
                                    <p>有効期限: <?= $payment['validity_period']; ?></p>
                                </div>
                                <div>
                                    <a href="manage_payment_execution.php?UseNumber=<?= $payment['pay_id']; ?>" class="payment-button">使用</a>
                                    <a href="manage_payment_execution.php?RemoveNumber=<?= $payment['pay_id']; ?>" class="payment-remove">削除</a>
                                </div>
                            </li>
                            <hr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>登録済みの支払い方法がありません。</p>
            <?php endif; ?>
        </div>
    </div>
</main>
<div style="text-align: center">
<a href="<?=$_SESSION['url']?>" class="button1">戻る</a>
</div>
<?php
if(isset($_GET['result'])){
    echo '<script>
            window.onload = function() {
            alert("新規支払方法を登録しました。");
            };
        </script>';
}
?>
<script src="../script/script.js"></script>
<script>
function formatCardNumber(input){
    // 入力値から数字のみを抽出
    let value = input.value.replace(/[^0-9]/g, '');

    // フォーマットを適用 (4桁-4桁-4桁-4桁形式)
    let formattedValue = '';
    for (let i = 0; i < value.length; i += 4) {
        if (i > 0) {
            formattedValue += '-';
        }
        formattedValue += value.substring(i, i + 4);
    }

    input.value = formattedValue;
}

function formatExpiryDate(input) {
    // 入力値から数字のみを抽出
    let value = input.value.replace(/[^0-9]/g, '');
    
    // フォーマットを適用 (2桁-2桁形式)
    if (value.length > 2) {
        value = value.slice(0, 2) + '/' + value.slice(2, 4);
    }
    
    // 入力欄に反映
    input.value = value;
}
</script>
</body>
</html>
