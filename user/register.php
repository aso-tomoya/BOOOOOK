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
            <label for="postcord">郵便番号*</label>
            <input type="text" name="postcord" id="postcord" oninput="formatPostalCode(this)" required>
        </div>

        <div class="form-group">
            <p><label for="post_code">郵便番号*</label></p>
            <p><input type="text" name="postal_code" id="postal_code" class="postal_code" pattern="\d{3}-\d{4}"></p>
        </div>

        <?php if(isset($_GET['error']) && $_GET['error'] == 'duplicate'){ echo '<p style="color:red;">このメールアドレスは既に登録されています。</p>'; } ?>

        <div class="button-container">
            <a href="login.php" class="button2">戻る</a>
            <input type="submit" class="button1" name="action" value="アカウント作成">
        </div>
        <p style="text-align:center"><input type="submit" class="button" name="action" value="アカウント作成">
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
