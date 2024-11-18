<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>ログイン</title>
</head>
<style>
        .button1 {
            width: 150px;
            background-color: #00CCFF;
            color: white;
            border-radius: 25px; /* 楕円形にする */
            padding: 8px 30px;
            border: none;
        }
        .button2 {
            width: 150px;
            background-color: white;
            color:#00CCFF ;
            border-radius: 25px; /* 楕円形にする */
            padding: 8px 30px;
            border: 1.5px solid #00CCFF;
        }
    </style>

<body>

<?php include '../header.php' ?>

<div class="login-container">
    <p class="login-title">boooookサイトログイン</p>
    <form action="login_execution.php" method="post" class="login-form">
        <div class="form-group">
            <label for="mail">ユーザーID(メールアドレス)</label>
            <input type="text" name="mail" id="mail" required>
        </div>
        <div class="form-group">
            <label for="password">パスワード</label>
            <input type="password" name="password" id="password" required><br>
        </div>

        <?php
            if(isset($_GET['error'])){
                echo '<p style="color:red">メールアドレスかパスワードが正しくありません。</p>';
            }    
        ?>

        <input type="submit" class="button1" name="action" value="ログイン">
    </form>

    <div class="register-section">
        <h3>アカウントをお持ちでない方</h3>
        <form action="register.php">
            <input type="submit" class="button2" name="action" value="新規会員登録">
        </form>
    </div>

</div>
<a href="../admin/login.php" class="admin-login-link">管理者としてログイン</a>

</body>
</html>
