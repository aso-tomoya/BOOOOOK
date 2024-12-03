<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>商品追加</title>
</head>
<body>
<form action=".php" method="post" enctype="multipart/form-data">
<?php include_once '../header.php' ?>
商品の追加
タイトル
<input type="text" name="title">
ジャンル
<input type="text" name="genre">
作者名
<input type="text" name="author">
金額
<input type="text" name="item_price">
発売日
<input type="text" name="relaese_date">
説明
<textarea name="summary" id="summary" rows="4"></textarea>
<input type="file" name="file">

</body>
</html>
