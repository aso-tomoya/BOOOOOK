<?php
$pdo = new PDO(
    'mysql:host=mysql311.phy.lolipop.lan;
        dbname=LAA1557203-boooook;charset=utf8',
    'LAA1557203',
    'boooook'
);

if (is_uploaded_file($_FILES['item_img']['tmp_name'])) {
    if (!file_exists('/home/users/2/main.jp-aso2301380/web/BOOOOOK/img')) {
        mkdir('/home/users/2/main.jp-aso2301380/web/BOOOOOK/img');
    }
}
$file = '/home/users/2/main.jp-aso2301380/web/BOOOOOK/img/' . basename($_FILES['item_img']['name']);
move_uploaded_file($_FILES['item_img']['tmp_name'], $file);

$title = $_POST['title'];
$genre = $_POST['genre'];
$author = $_POST['author'];
$item_price = mb_convert_kana($_POST['item_price'], 'n');
$relaese_date = mb_convert_kana($_POST['relaese_date'], 'n');
$summary = $_POST['summary'];
$item_img = mb_convert_kana($_FILES['item_img']['tmp_name']);


// 新規登録処理
$sql = $pdo->prepare('INSERT INTO item(item_name, author, item_price, release_date, summary, genre_id, item_img) VALUES(?,?,?,?,?,?,?)');
$result = $sql->execute([$title, $author, $item_price, $relaese_date, $summary, $genre, $item_img]);
$pdo = null;
if ($result) {
    header('Location: manage_products.php'); // 商品管理画面にリダイレクト
    exit();
} else {
    header('Location: add_product.php?error=true'); // 商品管理画面にリダイレクト
    exit();
}
