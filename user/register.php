<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>ユーザー登録</title>
    <?php include('../header.php');?>
</head>
<style>
        .button {
            width: 200px;
            background-color: #00CCFF;
            color: white;
            border-radius: 25px; /* 楕円形にする */
            padding: 8px 30px;
            border: none;
        }
        .textbox{
            width: 350px;
            border-radius: 25px; /* 楕円形にする */
            padding: 4px 10px;
            border: 1.5px solid #000000;
        }
        .postal_code{
            width: 140px;
            border-radius: 25px; /* 楕円形にする */
            padding: 4px 10px;
            border: 1.5px solid #000000;
        }
    </style>
<body>
<div style="border: solid 1px #000000; padding: 20px 30px; border-width: 2px; border-radius: 10px; margin: 10px 400px;">

<div class="register-container">
    <h2 class="register-title" style="text-align:center">アカウントを作成</h2>
    <p>*は必須項目</p>
    <?php if (isset($_GET['error'])): ?>
        <p style="color: red;">
            <?php
            if ($_GET['error'] == '1') {
                echo '未入力の項目があります';
            } elseif ($_GET['error'] == '2') {
                echo 'パスワードが異なっています';
            }
            ?>
        </p>
    <?php endif; ?>
    <?php ob_start(); ?> 
    <form action="register_execution.php" method="post" class="register-form">
        <div class="form-group">
            <label for="name">氏名*</label><br>
            <p style="text-align:center"><input type="text" name="name" id="name" class="textbox"><br>
        </div>
        <div class="form-group">
            <label for="mail_address">メールアドレス*</label><br>
            <p style="text-align:center"><input type="email" name="mail_address" id="mail_address" class="textbox"><br>
        </div>
        <div class="form-group">
            <label for="user_pass" >パスワード*</label><br>
            <p style="text-align:center"><input type="password" name="user_pass" id="user_pass" class="textbox"><br>
        </div>
        <div class="form-group">
            <label for="confirm_pass">パスワードを確認*</label><br>
            <p style="text-align:center"><input type="password" name="confirm_pass" id="confirm_pass" class="textbox"><br>
        </div>
        <div class="form-group">
            <p><label for="post_code">郵便番号*</label></p>
            <p><input type="text" name="postal_code" id="postal_code" class="postal_code" pattern="\d{3}-\d{4}"></p>
        </div>
        <div class="form-group">
            <label for="address">住所(建物名も含む)*</label><br>
            <p style="text-align:center"><input type="text" name="address" id="address" class="textbox"><br><br>
        </div>
        <p style="text-align:center"><input type="submit" class="button" name="action" value="アカウント作成">
    </form>
</div>

</div>

<script src="../script/script.js"></script>
</body>
</html>
