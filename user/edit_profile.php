<?php
session_start();
<<<<<<< HEAD
include '../header.php' ;
=======

include_once ('../header.php');

>>>>>>> origin/tomoya
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>ユーザー情報変更</title>
</head>
<body>
<<<<<<< HEAD
<div style="border: solid 1px #000000; padding: 20px 30px; border-width: 2px; border-radius: 10px; margin: 10px 400px;">
=======
<!-- ユーザー情報取得 -->
<?php
include_once ('../method/userGet.php');
$user = getUser($db, $_SESSION['user_id']);
?>
>>>>>>> origin/tomoya

<div class="form-container">
    <h2 class="form-title">アカウント情報を変更</h2>
    <p>*変更する項目のみ編集してください</p>
    <form action="mypage.php" method="post" class="form">
        <div class="form-group">
            <label for="name">氏名</label>
            <input type="text" name="name" id="name" value="<?=$user['name']?>" required>
        </div>
        <div class="form-group">
<<<<<<< HEAD
            <label for="mail">メールアドレス</label><br>
            <p style="text-align:center"><input type="text" name="mail_address" id="mail_address" class="textbox" <?=$_SESSION['mail_address']?> required><br>
        </div>
        <div class="form-group">
            <p><label for="postcord">郵便番号</label></p>
            <p><input type="text" name="postcord" id="postal_code" class="postal_code" <?=$_SESSION['postal_code']?> required></p>
=======
            <label for="mail">メールアドレス</label>
            <input type="text" name="mail" id="mail" value="<?=$user['mail_address']?>" required>
        </div>
        <div class="form-group">
            <label for="postcord">郵便番号</label>
            <input type="text" name="postcord" value="<?=$user['postal_code']?>" required>
>>>>>>> origin/tomoya
        </div>
        <div class="form-group">
            <label for="address">住所(建物名も含む)</label>
            <input type="text" name="address" id="address" value="<?=$user['address']?>" required>
        </div>
        
        <?php if(isset($_GET['error']) && $_GET['error'] == 'duplicate'){ echo '<p style="color:red;">このメールアドレスは既に登録されています。</p>'; } ?>

        <div class="button-container">
        <input type="submit" class="button2" name="back" value="編集せずに戻る">
        <input type="submit" class="button1" value="完了">
        </div>
    </form>
</div>


<script src="../script/script.js"></script>
</body>
</html>
