<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../script/style.css">
    <title>検索結果</title>
</head>
<body>

<?php include '../header.php' ?>
<div class="container">
    <h2>「〇〇〇」の検索結果</h2>
    <p>〇〇件</p>
    <div class="sort-options">
        <button>人気順</button>
    </div>
    <div class="item-list">
        <!-- Each item -->
        <div class="item">
            <img src="placeholder.png" alt="Book Cover">
            <div class="title">タイトル</div>
            <div class="author">作者</div>
            <div class="price">価格 ￥〇〇</div>
            <div class="genre">ジャンル</div>
        </div>
        <div class="item">
            <img src="placeholder.png" alt="Book Cover">
            <div class="title">タイトル</div>
            <div class="author">作者</div>
            <div class="price">価格 ￥〇〇</div>
            <div class="genre">ジャンル</div>
        </div>
        <!-- Repeat items as needed -->
    </div>
</div>

</body>
</html>