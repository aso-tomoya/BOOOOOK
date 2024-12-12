<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
<<<<<<< Updated upstream
    <title>Document</title>
=======
    <title>商品管理</title>
>>>>>>> Stashed changes
</head>
<body>

<?php include_once '../header.php';?>
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
<<<<<<< Updated upstream
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
=======
        $stmt->execute([$search_term,$search_term,$search_term,$search_term]);
?>
<?php foreach ($pdo->query('SELECT * FROM item') as $row): ?>
        <div class="pro-info" style="width: 100%;">
            <div class="item-box">
                <form method="post" action="delete_item.php">
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
<?php endforeach; ?>

<?php
        // foreach($pdo->query('select * from item') as $row){
        //     echo '<div class="pro-info">';
        //     echo '<div style="-moz-border-radius: 10px; -webkit-border-radius: 10px; border-radius: 10px; border: #a9a9a9 solid 1px; font-size: 100%; padding: 20px;width: 320px;height: 150px;">';
        //     echo '<form="delete_item.php" method="post">';
        //     echo '<img src="../img/',$row['item_img'],'">';
        //     echo $row['item_name'],'<br>';
        //     echo $row['author'],'<br>';
        //     echo $row['item_price'],'円<br>';
        //     echo '<p style="text-align:right"><input type="submit" value="商品削除">';
        //     echo '</div>';
        //     echo '<br>';
        //     echo '</div>';
        // }
    }
        $pdo = null;
?>
>>>>>>> Stashed changes
</body>
</html>