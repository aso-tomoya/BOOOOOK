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


<p>boooookサイトログイン</p>
    <form action="login_out.php" method="post">
        <p>ユーザーID(メールアドレス)</p>
        <input type="text" name="mail" id="login" required>
        <p>パスワード</p>
        <input type="password" name="password" id="login" required><br>
    <?php
        if (isset($_GET['error'])) {
            if ($_GET['error'] == 1) {
            echo "<p style='color:red;'>メールアドレスまたはパスワードが間違っています。</p>";
        } elseif ($_GET['error'] == 2) {
        echo "<p style='color:red;'>メールアドレスとパスワードを入力してください。</p>";
    }
}
?>
        <br><input type="submit" class="button1" name="action" value="ログイン"><br>
    </form>
    <h3>アカウントをお持ちでない方</h3>
    <form action="register.php">
<input type="submit" class="button2" name="action" value="新規会員登録">
</form>
<a href="../admin/login.php"  style=color:red>管理者としてログイン</a>

</body>
</html>
