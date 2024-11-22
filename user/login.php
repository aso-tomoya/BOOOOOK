<!-- 完成 -->

<?php include('../header.php'); ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>BOOOOOK-ログイン</title>
</head>
<<<<<<< HEAD

=======
>>>>>>> 872279199991c0b080c1f4bbbb05721f0f6162ba

<body>

<div class="login-container">
    <p class="login-title" >boooookサイトログイン
    <form action="login_execution.php" method="post" class="login-form">
        <div class="form-group">
            <label for="mail">ユーザーID(メールアドレス)</label><br>
            <input type="text" name="mail" id="mail" class="mail" required><br>
        </div>
        <div class="form-group">
            <label for="password" >パスワード</label><br>
            <input type="password" name="password" id="password" class="pass" required><br><br>
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
        <form action="register.php">
        <input  type="submit" class="button2" name="action" value="新規会員登録" >
        </form>
    </div>
</div>

<a href="../admin/login.php" class="admin-login-link">管理者としてログイン</a>

</body>
</html>
