<?php
$pdo = new PDO('mysql:host=mysql311.phy.lolipop.lan;
        dbname=LAA1557203-boooook;charset=utf8',
        'LAA1557203',
        'boooook');

$title = $_POST['title'];
$genre = $_POST['genre'];
$author = $_POST['author'];
$item_price = mb_convert_kana($_POST['item_price'], 'n');
$relaese_date = mb_convert_kana($_POST['relaese_date'], 'n');
$summary = $_POST['summary'];
$item_img = mb_convert_kana($_POST['item_img'], 'an');


    // 新規登録処理
    $sql = $pdo->prepare('INSERT INTO item(title, genre, author, item_price, relaese_date, summary, item_img) VALUES(?,?,?,?,?,?,?)');
    $result = $sql->execute([$title, $genre, $author, $item_price, $relaese_date, $summary, $item_img]);
    $pdo = null;
    if($result){
        header('Location: manage_products.php'); // 商品管理画面にリダイレクト
        exit();
    }else{
        header('Location: add_product.php?error=true'); // 商品管理画面にリダイレクト
        exit();
    }
?>