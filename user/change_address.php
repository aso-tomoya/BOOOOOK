<?php
session_start();
include_once ('../header.php');
$url = $_SERVER['HTTP_REFERER'];
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>BOOOOOK-お届け先変更</title>
</head>
<body>

<div class="form-container">
    <h2 class="form-title">新しいお届け先</h2>
    <form action="change_address_execution.php" method="post" class="form">
        <div class="form-group">
            <label for="name">氏名</label>
            <input type="text" name="name" id="name" required>
        </div>
        <div class="form-group">
            <label for="postcord">郵便番号</label>
            <input type="text" name="postcord" id="postcord" required>
        </div>
        <div class="form-group">
            <label for="address">住所(建物名含む)</label>
            <input type="text" name="address" id="address" required>
        </div>
        <div class="form-group">
            <label for="default-address">
                <input type="checkbox" name="check" id="default-address">
                いつもここに届ける (住所を変更)
            </label>
        </div>
<input type="hidden" name="url" value="<?=$url?>">
        <div class="button-container">
            <a href="<?=$url?>" class="button2">変更せずに戻る</a>
            <input type="submit" class="button1" value="お届け先を変更">
        </div>
    </form>
</div>

<script src="../script/script.js"></script>
</body>
</html>
