<?php

// 完成
$pdo = new PDO('mysql:host=mysql311.phy.lolipop.lan;
        dbname=LAA1557203-boooook;charset=utf8',
        'LAA1557203',
        'boooook');

$name = $_POST['name'];
$mail = $_POST['mail'];
$password1 = $_POST['password1'];
$password2 = $_POST['password2'];
$postcord = $_POST['postcord'];
$address = $_POST['address'];

// メールアドレスの重複チェック
$sql = $pdo->prepare('SELECT * FROM user WHERE mail_address = ?');
$sql->execute([$mail]);
$existingUser = $sql->fetch();

if ($existingUser) {
    // メールアドレスが重複している場合
    header('Location: register.php?error=duplicate'); // 登録画面にリダイレクト（エラーを表示）
    exit();
} else {
    // 新規登録処理
    $sql = $pdo->prepare('INSERT INTO user(name, mail_address, user_pass, postal_code, address) VALUES(?,?,?,?,?)');
    $sql->execute([$name, $mail, $password1, $postcord, $address]);
    $pdo = null;
    header('Location: login.php'); // ログイン画面にリダイレクト
    exit();
}
?>
