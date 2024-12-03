<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>管理者ログイン</title>
</head>
<body>

<?php include_once '../header.php' ?>

<div class="login-container">
    
    <form action="login_execution.php" method="post" class="login-form">
        <div class="form-group">
            <label for="mail">管理者ID</label><br>
            <input type="text" name="admin_id" id="admin_id" class="admin_id" required><br>
        </div>
        <div class="form-group">
            <label for="password" >パスワード</label><br>
            <input type="password" name="admin_pass" id="admin_pass" class="admin_pass" required><br><br>
        </div>

        <?php
            if(isset($_GET['error'])){
                echo '<p style="color:red" >管理者IDかパスワードが正しくありません。';
            }    
        ?>

        <input type="submit" class="button1" name="action" value="ログイン">
    </form>

</body>
</html>
