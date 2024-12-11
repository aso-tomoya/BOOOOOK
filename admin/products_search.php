<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
$pdo = new PDO('mysql:host=mysql311.phy.lolipop.lan;
        dbname=LAA1557203-boooook;charset=utf8',
        'LAA1557203',
        'boooook');

        if(isset($_POST['word'])){
            $search_term = '%' . $_POST['word'] . '%';
            
        $sql='select * from item inner join genre ON item.genre_id = genre.genre_id where item.item_name LIKE ? or item.author LIKE ? or item.summary LIKE ?  or genre.genre_name LIKE ?';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$search_term,$search_term,$search_term,$search_term]);

        foreach($pdo->query('select * from item') as $row){
            echo '<div class="pro-info">';
            echo '<div style="-moz-border-radius: 10px; -webkit-border-radius: 10px; border-radius: 10px; border: #a9a9a9 solid 1px; font-size: 100%; padding: 20px;width: 320px;height: 150px;">';
            echo '<form="product_delete.php" method="post">';
            echo '<img src="../img/',$row['item_img'],'">';
            echo $row['item_name'],'<br>';
            echo $row['author'],'<br>';
            echo $row['item_price'],'円<br>';
            echo '<p style="text-align:right"><input type="submit" value="商品削除">';
            echo '</div>';
            echo '<br>';
            echo '</div>';
        }
    }
        $pdo = null;
        ?>
</body>
</html>