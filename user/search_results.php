<?php
session_start();

// ヘッダー呼び出し
include_once ('../header.php');
// メソッドファイル呼び出し
include_once ('../method/itemGet.php');

$word = $_GET['searchWord'] ? $_GET['searchWord'] : $getGenre($db, $_GET['genre'])['genre_name'];
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>BOOOOOK-<?=$word?>の検索結果</title>
</head>
<body>


<div class="container">
    <h2><?=$word?>の検索結果</h2>
    <p>件</p>
    <div class="sort-options">
        <button>人気順</button>
    </div>
    <div class="item-list">
        
    </div>
</div>

<script src="../script/script.js"></script>
</body>
</html>