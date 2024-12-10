<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>商品追加</title>
</head>
<body>
<?php include_once '../header.php' ?>
<div class="form-container">
<h2 class="form-title">商品の追加</h2>
<?php if(isset($_GET['error'])){
    echo '<p style="color:red" >商品の登録に失敗しました';
}
?>
<form action="add_pro_execution.php" method="post" enctype="multipart/form-data" class="form">
<div class="form-group">
    <label for="title">タイトル</label>
    <input type="text" name="title" id="title" required>
</div>
<div class="form-group">
    <label for="genre">ジャンル</label>
    <input type="text" name="genre" list="genre" autocomplete="off">
    <datalist id="genre">
            <option value="1">文学・小説</option>
            <option value="2">マンガ</option>
            <option value="3">ライトノベル</option>
            <option value="4">ミステリー・サスペンス</option>
            <option value="5">SF・ファンタジー</option>
            <option value="6">ビジネス・経済</option>
            <option value="7">自己啓発・健康</option>
            <option value="8">趣味・ホビー</option>
            <option value="9">科学・技術</option>
            <option value="10">歴史・地理</option>
            <option value="11">アート・デザイン</option>
</datalist>
</div>
<div class="form-group">
    <label for="author">作者名</label>
    <input type="text" name="author" id="author" required>
</div>
<div class="form-group">
    <label for="item_price">金額</label>
    <input type="text" name="item_price" id="item_price" required>
</div>
<div class="form-group">
    <label for="relaese_date">発売日</label>
    <input type="date" name="relaese_date" id="relaese_date" required>
</div>
<div class="form-group">
    <label for="summary">説明</label>
    <textarea name="summary" id="summary" rows="4"></textarea>
</div>
<div class="form-group">
    <label for="item_img">画像をアップロード</label>
    <input type="file" name="item_img" id="item_img" required>
</div>

<div class="button-container">
    <a href="manage_products.php" class="button2">追加せずに戻る</a>
    <input type="submit" class="button1" name="action" value="追加">
</div>
</div>
</form>
</body>
</html>
