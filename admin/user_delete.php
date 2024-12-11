<?php
ob_start();
if(isset($_POST['check'])){
    $ids = $_POST['check'];
    $pdo=new PDO('mysql:host=mysql311.phy.lolipop.lan;
    dbname=LAA1557203-boooook;charset=utf8',
    'LAA1557203',
    'boooook');
    
    // ユーザーのpay_idをnullに
    $sql='UPDATE user SET pay_id = null WHERE user_id in (' . implode(',', array_map('intval', $ids)) . ')';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // payment_infoのユーザーidをnullに
    $sql='UPDATE payment_info SET user_id = null WHERE user_id in (' . implode(',', array_map('intval', $ids)) . ')';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    // order_detailのユーザーidをnullに
    $sql='UPDATE order_detail SET user_id = null WHERE user_id in (' . implode(',', array_map('intval', $ids)) . ')';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $sql='DELETE FROM user WHERE user_id in (' . implode(',', array_map('intval', $ids)) . ')';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    header('Location: manage_users.php');
    exit();
}else{
    header('Location: manage_users.php?error=true');
    exit();
}
ob_end_flush(); 
$pdo=null;
?>