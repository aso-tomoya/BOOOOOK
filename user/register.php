<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>ユーザー登録</title>
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
            width: 200px;
            border-radius: 25px; /* 楕円形にする */
            padding: 4px 10px;
            border: 1.5px solid #000000;
        }
        .postcord{
            width: 130px;
            border-radius: 25px; /* 楕円形にする */
            padding: 4px 10px;
            border: 1.5px solid #000000;
        }
    </style>
<body>

<?php include '../header.php' ?>

<div style="border: solid 1px #000000; padding: 30px; border-width: 2px; border-radius: 10px; margin: 10px 400px;">

<div class="register-container">
    <h2 class="register-title" style="text-align:center">アカウントを作成</h2>
    <p></p>
    <form action="register_execution.php" method="post" class="register-form">
        <div class="form-group">
            <p style="text-align:center"><label for="name">氏名*</label><br>
            <p style="text-align:center"><input type="text" name="name" id="name" class="textbox" required><br>
        </div>
        <div class="form-group">
            <p style="text-align:center"><label for="mail">メールアドレス*</label><br>
            <p style="text-align:center"><input type="text" name="mail" id="mail" class="textbox" required><br>
        </div>
        <div class="form-group">
            <p style="text-align:center"><label for="password1" >パスワード*</label><br>
            <p style="text-align:center"><input type="password" name="password1" id="password1" class="textbox" required><br><br>
        </div>
        <div class="form-group">
            <p style="text-align:center"><label for="password2">パスワードを確認*</label><br>
            <p style="text-align:center"><input type="password" name="password2" id="password2" class="textbox" required><br>
        </div>
        <div class="form-group">
            <p style="text-align:center"><label for="postcord">郵便番号*</label><br>
            <p style="text-align:center"><input type="text" name="postcord" id="postcord" class="postcord" required><br>
        </div>
        <div class="form-group">
            <p style="text-align:center"><label for="address">住所(建物名も含む)*</label><br>
            <p style="text-align:center"><input type="text" name="address" id="address" class="textbox" required><br>
        </div>

        <?php
            if(isset($_GET['error'])){
                echo '<p style="color:red" style="text-align:center">メールアドレスかパスワードが正しくありません。</p>';
            }    
        ?>

        <p style="text-align:center"><input type="submit" class="button" name="action" value="アカウント作成">
    </form>
</div>

</div>

<script src="../script/script.js"></script>
</body>
</html>
