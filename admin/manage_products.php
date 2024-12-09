<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>商品管理</title>
</head>
<body>

<?php include_once '../header.php';


$pdo=new PDO('mysql:host=mysql311.phy.lolipop.lan;
    dbname=LAA1557203-boooook;charset=utf8',
    'LAA1557203',
    'boooook');
?>

<div class="search-bar">
    <input type="text" placeholder="検索">
    <button>🔍</button>
</div>
<form action="add_product.php">
<input type="submit" value="商品追加">
</form>
<?php

foreach($pdo->query('select * from item') as $row){
    echo '<div class="pro-info">';
    echo '<div style="-moz-border-radius: 10px; -webkit-border-radius: 10px; border-radius: 10px; border: #a9a9a9 solid 1px; font-size: 100%; padding: 20px;width: 320px;height: 150px;">';
    echo '<img src="../img/',$row['item_img'],'">';
    echo $row['item_name'],'<br>';
    echo $row['author'],'<br>';
    echo $row['item_price'],'円<br>';
    echo '<p style="text-align:right"><input type="submit" value="商品削除">';
    echo '</div>';
    echo '<br>';
    echo '</div>';
}
$pdo = null;
?>
</body>
</html>
