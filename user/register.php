<!-- ヘッダー呼び出し -->
<?php include('../header.php'); ?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>ユーザー登録</title>
</head>

<body>

<div class="login-container">
    <h2 class="login-title">アカウントを作成</h2>
    <p>*は必須項目</p>
    <form action="register_execution.php" method="post" class="login-form">
        <div class="form-group">
            <label for="name">氏名*</label>
            <input type="text" name="name" id="name" required>
        </div>

        <div class="form-group">
            <label for="mail">メールアドレス*</label>
            <input type="email" name="mail" id="mail" required>
        </div>

        <div class="form-group">
            <label for="password1">パスワード*</label>
            <input type="password" name="password1" id="password1" required>
        </div>

        <div class="form-group">
            <label for="password2">パスワードを確認*</label>
            <input type="password" name="password2" id="password2" required>
            <p id="password-error"></p> <!-- エラーメッセージ表示用 -->
        </div>

        <div class="form-group">
            <label for="postcord">郵便番号*</label>
            <input type="text" name="postcord" id="postcord" required>
        </div>

        <div class="form-group">
            <label for="address">住所(建物名も含む)*</label>
            <input type="text" name="address" id="address" required>
        </div>

        <?php if(isset($_GET['error2'])){ echo '<p style="color:red;">未入力の項目があります。</p>'; } ?>

        <div class="form-group">
            <input type="submit" class="button1" name="action" value="アカウント作成">
        </div>
    </form>
</div>

<script src="../script/script.js"></script>
</body>
</html>
