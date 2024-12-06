<?php
session_start();

include_once ('../header.php');

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>BOOOOOK-ユーザー情報変更</title>
</head>
<body>
<!-- ユーザー情報取得 -->
<?php
include_once ('../method/userGet.php');
$user = getUser($db, $_SESSION['user_id']);
?>

<div class="form-container">
    <h2 class="form-title">アカウント情報を変更</h2>
    <p>*変更する項目のみ編集してください</p>
    <form action="edit_profile_execution.php" method="post" class="form">
        <div class="form-group">
            <label for="name">氏名</label>
            <input type="text" name="name" id="name" value="<?=$user['name']?>" required>
        </div>
        <div class="form-group">
            <label for="mail">メールアドレス</label>
            <input type="text" name="mail" id="mail" value="<?=$user['mail_address']?>" required>
        </div>
        <!-- メールアドレス変更のチェック用 -->
         <input type="hidden" name="beforMail" value="<?=$user['mail_address']?>">
        <div class="form-group">
            <label for="postcord">郵便番号</label>
            <input type="text" name="postcord" value="<?=$user['postal_code']?>" oninput="formatPostalCode(this)" required>
        </div>
        <div class="form-group">
            <label for="address">住所(建物名も含む)</label>
            <input type="text" name="address" id="address" value="<?=$user['address']?>" required>
        </div>
        <input type="hidden" name="user_id" value="<?=$_SESSION['user_id']?>">
        <?php if(isset($_GET['error']) && $_GET['error'] == 'duplicate'){ echo '<p style="color:red;">このメールアドレスは既に登録されています。</p>'; } ?>

        <div class="button-container">
        <a href="mypage.php" class="button2">変更せずに戻る</a>
        <input type="submit" class="button1" value="完了">
        </div>
    </form>
</div>


<script src="../script/script.js"></script>
<script>
    function formatPostalCode(input) {
            // 入力値から数字のみを抽出
            let value = input.value.replace(/[^0-9]/g, '');
            
            // フォーマットを適用 (3桁-4桁形式)
            if (value.length > 3) {
                value = value.slice(0, 3) + '-' + value.slice(3, 7);
            }
            
            // 入力欄に反映
            input.value = value;
        }
</script>
</body>
</html>
