<?php
session_start();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>ユーザー情報変更</title>
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
        .postcord{
            width: 130px;
            border-radius: 25px; /* 楕円形にする */
            padding: 4px 10px;
            border: 1.5px solid #000000;
        }
    </style>
<body>
<?php include '../header.php' ?>
<div style="border: solid 1px #000000; padding: 20px 30px; border-width: 2px; border-radius: 10px; margin: 10px 400px;">

<div class="edit_profile-container">
    <h2 class="edit_profile-title" style="text-align:center">アカウント情報を変更</h2>
    <p>*変更する項目のみ編集してください</p>
    <form action="mypage.php" method="post" class="mypage-form">
        <div class="form-group">
            <label for="name">氏名</label><br>
            <p style="text-align:center"><input type="text" name="name" id="name" class="textbox" value="<?=$_SESSION['name']?>" required><br>
        </div>
        <div class="form-group">
            <label for="mail">メールアドレス</label><br>
            <p style="text-align:center"><input type="text" name="mail" id="mail" class="textbox" <?=$_SESSION['mail_address']?> required><br>
        </div>
        <div class="form-group">
            <p><label for="postcord">郵便番号</label></p>
            <p><input type="text" name="postcord" id="postcord" class="postcord" <?=$_SESSION['postal_cord']?> required></p>
        </div>
        <div class="form-group">
            <label for="address">住所(建物名も含む)</label><br>
            <p style="text-align:center"><input type="text" name="address" id="address" class="textbox" <?=$_SESSION['address']?> required><br><br>
        </div>
        

        <input type="submit" class="button" name="action" value="完了">
    </form>
</div>

</div>

<script src="../script/script.js"></script>
</body>
</html>
