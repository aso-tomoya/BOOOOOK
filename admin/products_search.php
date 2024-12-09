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
            
        $sql='select * from item inner join genre ON item.genre_id = genre.genre_id 
        where item.item_name LIKE ? or item.author LIKE ? or item.summary LIKE ?  or genre.genre_name LIKE ?';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$search_term]);

        }
?>
</body>
</html>