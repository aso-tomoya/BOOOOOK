<?php
session_start();
header('Content-Type: application/json');

// リクエストデータを取得
$data = json_decode(file_get_contents('php://input'), true);

// 商品IDが送信されているか確認
if (isset($data['itemId'])) {
    $itemId = $data['itemId'];

    // セッションのカートが存在しない場合は初期化
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // 商品IDをカートに追加
    $_SESSION['cart'][] = $itemId;

    // レスポンスを返す
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => '商品IDが指定されていません']);
}
?>
