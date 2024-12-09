<?php
session_start();

include_once ('../method/userGet.php');

$pdo = new PDO('mysql:host=mysql311.phy.lolipop.lan;
        dbname=LAA1557203-boooook;charset=utf8',
        'LAA1557203',
        'boooook');

// 新規登録処理 
// 同じカードがないかチェック
if(isset($_POST['addNewCard'])){
    $userId = $_SESSION['user_id'];

    $number = $_POST['cNumber'];
    $name = $_POST['cName'];
    $date = $_POST['expiryDate'];
    $code = $_POST['securityCode'];

    $sql = $pdo->prepare('SELECT * FROM payment_info where card_number = ? AND user_id = ?');
    $sql->execute([$number, $userId]);
    $result = $sql->fetch();
    if($result){
        header('Location: manage_payment.php?error1=true');
        exit();
    }else{
        $sql = $pdo->prepare('INSERT INTO payment_info(user_id,card_number,card_name,validity_period,security_code) VALUES(?,?,?,?,?)');
        $sql->execute([$userId,$number,$name,$date,$code]);
        $sql = null;
        header('Location: manage_payment.php?result1=true');
        exit();
    }
}

// 支払い方法の使用設定
if(isset($_GET['UseNumber'])){
    $payId = $_GET['UseNumber'];
    $userId = $_SESSION['user_id'];

    $sql = $pdo->prepare('UPDATE user SET pay_id = ? WHERE user_id = ?');
    $sql->execute([$payId, $userId]);
    header('Location: manage_payment.php?result2=true');
    exit();
}

// 支払い方法の削除
if(isset($_GET['RemoveNumber'])){
    $payId = $_GET['RemoveNumber'];
    $userId = $_SESSION['user_id'];

    $sql = $pdo->prepare('DELETE FROM payment_info WHERE pay_id = ? AND user_id = ?');
    $sql->execute([$payId, $userId]);
    header('Location: manage_payment.php?result3=true');
    exit();
}
?>
