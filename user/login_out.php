<?php
ob_start();
session_start();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
$pdo=new PDO('mysql:host=mysql311.phy.lolipop.lan;
            dbname=LAA1557217-boooook;charset=utf8',
            'LAA1557217',
            'boooook');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            if (isset($_POST['mail']) && isset($_POST['password'])) {
                $email = $_POST['mail'];
                $password = $_POST['password'];
            
                // ユーザー情報をデータベースから取得
                $stmt = $pdo->prepare("SELECT * FROM user WHERE mail_address = :email");
                $stmt->bindParam(':email', $email);
                $stmt->execute();
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
                // パスワードの照合
                if ($user && $password == $user['password']) {
                    $_SESSION['user_id'] = $user['user_id'];
                    $_SESSION['email'] = $user['mail_address'];
                    header("Location: index.php"); // ログイン成功後のリダイレクト先
                    exit();
                } else {
                    // ログイン失敗時のリダイレクト
                    header("Location: login.php?error=1");
                    exit();
                }
            } else {
                // フォームデータが送信されていない場合の処理
                header("Location: login.php?error=2");
                exit();
            }
            ob_end_flush();
?>

</body>
</html>