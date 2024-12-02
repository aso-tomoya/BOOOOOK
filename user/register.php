<!-- ヘッダー呼び出し -->
<?php include_once('../header.php'); ?>

<!-- 完成 -->

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>ユーザー登録</title>
</head>

<body>

<div class="form-container">
    <h2 class="form-title">アカウントを作成</h2>
    <p>*は必須項目</p>
    <form action="register_execution.php" method="post" class="form">
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

        <?php if(isset($_GET['error']) && $_GET['error'] == 'duplicate'){ echo '<p style="color:red;">このメールアドレスは既に登録されています。</p>'; } ?>

        <div class="form-group">
            <input type="submit" class="button1" name="action" value="アカウント作成">
        </div>
    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
    const password1 = document.getElementById("password1");
    const password2 = document.getElementById("password2");
    const errorMessage = document.getElementById("password-error");
    const submitButton = document.querySelector(".button1"); // ボタンを取得

    // 初期状態でボタンを無効にする
    submitButton.disabled = true;

    // パスワード一致チェック
    function checkPasswordsMatch() {
        // password2が未入力の場合、チェックを行わない
        if (password2.value === "") {
            errorMessage.textContent = ""; // エラーメッセージをクリア
            password2.style.borderColor = ""; // デフォルトのスタイルに戻す
            submitButton.disabled = true; // ボタンを無効化
            return;
        }

        if (password1.value !== password2.value) {
            errorMessage.textContent = "パスワードが一致しません。";
            errorMessage.style.color = "red";
            password2.style.borderColor = "red";
            submitButton.disabled = true; // ボタンを無効化
        } else {
            errorMessage.textContent = ""; // エラーメッセージをクリア
            password2.style.borderColor = ""; // デフォルトのスタイルに戻す
            submitButton.disabled = false; // ボタンを有効化
        }
    }

    // 入力のたびにパスワードをチェック
    password1.addEventListener("input", checkPasswordsMatch);
    password2.addEventListener("input", checkPasswordsMatch);
});
</script>
</body>
</html>
