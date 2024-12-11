<?php
session_start();
if(!isset($_SESSION['admin_id'])){
    header('Location: login.php');
}
include '../header.php'
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>管理者トップ</title>
</head>

<body>

<div class="form-container">
    <form action="manage_products.php">
        <input type="submit" name="pro_ad" value="商品管理" class="button2">
    </form>

    <form action="manage_users.php">
        <input type="submit" name="user_ad" value="ユーザー管理" class="button2">
    </form>
</div>

</body>
</html>
