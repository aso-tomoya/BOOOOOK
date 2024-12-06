<?php
session_start();

// カートからの遷移を判定
$_SESSION['fromCart'] = false;
if(strpos($_SERVER['HTTP_REFERER'], '/cart.php')){
    $_SESSION['fromCart'] = true;
}

include_once('../header.php');
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>BOOOOOK-ログイン</title>
</head>

<body>

<div class="form-container">
    <h2 class="form-title" >ログイン</h2>

    <form action="login_execution.php" method="post" class="form">
        <div class="form-group">
            <label for="mail">ユーザーID(メールアドレス)</label><br>
            <input type="text" name="mail" id="mail" required><br>
        </div>
        <div class="form-group">
            <label for="password" >パスワード</label><br>
            <input type="password" name="password" id="password" required><br><br>
        </div>

        <?php
            if(isset($_GET['error'])){
                echo '<p style="color:red" >メールアドレスかパスワードが正しくありません。';
            }    
        ?>

        <input type="submit" class="button1" name="action" value="ログイン">
    </form>

    <div class="register-section">
        <h3 >アカウントをお持ちでない方</h3>
        <a href="register.php"><input type="submit" class="button2" name="action" value="新規会員登録"></a>
    </div>
</div>

<a href="../admin/login.php" class="admin-login-link">管理者としてログイン</a>

<script>
    // ページ読み込み時に実行
    window.onload = function() {
        // URLのクエリパラメータを取得
        const params = new URLSearchParams(window.location.search);
        
        // resultがtrueの場合にアラートを表示
        if (params.get('result') === 'true') {
            alert('新規登録に成功しました！続けてログインしてください');
        }
    };
</script>
</body>
</html>
