<?php
session_start();
header('Content-Type: application/json');

// カートの個数を計算
if (isset($_SESSION['cart'])) {
    $count = count($_SESSION['cart']);
    echo json_encode(['success' => true, 'count' => $count]);
} else {
    echo json_encode(['success' => true, 'count' => 0]); // カートが空の場合
}
?>
