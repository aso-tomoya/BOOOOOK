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
            width: 200px;
            background-color: #00CCFF;
            color: white;
            border-radius: 25px; /* 楕円形にする */
            padding: 8px 30px;
            border: none;
        }
        .button2 {
            width: 200px;
            background-color: white;
            color:#00CCFF ;
            border-radius: 25px; /* 楕円形にする */
            padding: 8px 30px;
            border: 1.5px solid #00CCFF;
        }
        .mail{
            width: 200px;
            border-radius: 25px; /* 楕円形にする */
            padding: 8px 10px;
            border: 1.5px solid #000000;
        }
        .pass{
            width: 200px;
            border-radius: 25px; /* 楕円形にする */
            padding: 8px 10px;
            border: 1.5px solid #000000;
        }
    </style>

<body>

<?php include '../header.php' ?>

<div style="border: solid 1px #000000; padding: 30px; border-width: 2px; border-radius: 10px; margin: 10px 400px;">

<div class="login-container">
    <p class="login-title" style="text-align:center">boooookサイトログイン</p>
    <form action="login_execution.php" method="post" class="login-form">
        <div class="form-group">
            <p style="text-align:center"><label for="mail">ユーザーID(メールアドレス)</label><br>
            <p style="text-align:center"><input type="text" name="mail" id="mail" class="mail" required><br>
        </div>
        <div class="form-group">
            <p style="text-align:center"><label for="password" >パスワード</label><br>
            <p style="text-align:center"><input type="password" name="password" id="password" class="pass" required><br><br>
        </div>

        <?php
            if(isset($_GET['error'])){
                echo '<p style="color:red" style="text-align:center">メールアドレスかパスワードが正しくありません。</p>';
            }    
        ?>

        <p style="text-align:center"><input type="submit" class="button1" name="action" value="ログイン">
    </form>

    <div class="register-section">
        <h3 style="text-align:center">アカウントをお持ちでない方</h3>
        <form action="register.php">
        <p style="text-align:center"><input  type="submit" class="button2" name="action" value="新規会員登録" >
        </form>
    </div>
</div>

</div>
<p style="text-align:right"><a href="../admin/login.php" class="admin-login-link">管理者としてログイン</a>

</body>
</html>
