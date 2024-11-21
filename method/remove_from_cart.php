<?php
session_start();

// 削除対象の商品IDを取得
$item_id = $_GET['item_id'] ?? null;

if ($item_id && isset($_SESSION['cart'])) {
    // 商品を1つだけ削除
    $key = array_search($item_id, $_SESSION['cart']);
    if ($key !== false) {
        unset($_SESSION['cart'][$key]);
        $_SESSION['cart'] = array_values($_SESSION['cart']); // 配列を再インデックス
    }
}

// カート一覧ページにリダイレクト
header('Location: ../user/cart.php');
exit;