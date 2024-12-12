<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Document</title>
</head>
<body>
<?php
include_once '../header.php';

$pdo = new PDO('mysql:host=mysql311.phy.lolipop.lan;
        dbname=LAA1557203-boooook;charset=utf8',
        'LAA1557203',
        'boooook');
?>
        <div class="form-container">

        <form action="manage_products.php" method="post">
        <button class="button1">商品一覧へ戻る</button>
        </form><br>

    <?php if(isset($_POST['word'])){
        $search_term = '%' . $_POST['word'] . '%';
            
        $sql='select * from item inner join genre ON item.genre_id = genre.genre_id where item.item_name LIKE ? or item.author LIKE ? or genre.genre_name LIKE ?';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$search_term,$search_term,$search_term]);
            foreach($stmt as $row):?>
                <div class="pro-info" style="width: 100%;">
                    <div class="item-box">
                        <form="product_delete.php" method="post">
                            <img src="../img/<?= $row['item_img'] ?>" alt="<?= $row['item_name'] ?>" style="width: 100px;">
                            <p><?= $row['item_name'] ?><br>
                            <?= $row['author'] ?><br>
                            <?= $row['item_price'] ?>円</p>
                            <p style="text-align:right">
                                <input type="hidden" name="item_id" value="<?= $row['item_id'] ?>">
                                <input type="submit" class="button2" value="商品削除">
                            </p>
                        </form>
                    </div>
                </div>
            <?php endforeach;
    }
    ?>
    </div>
</body>
</html>