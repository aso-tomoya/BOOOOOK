document.addEventListener('DOMContentLoaded', function() {
    const backToTopButton = document.getElementById('back-to-top');

    // スクロールイベントの設定
    window.addEventListener('scroll', function() {
        if (window.scrollY > 300) { // スクロールが300pxを超えた場合
            backToTopButton.classList.add('show');
        } else {
            backToTopButton.classList.remove('show');
        }
    });

    // クリックイベントでページトップにスクロール
    backToTopButton.addEventListener('click', function() {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
});

function goToItemPage(itemId){
    window.location.href = `product.php?id=${itemId}`;
}

function addToCart(itemId) {
    // alert("商品ID："+itemId+"をカートに追加しました！");
    
     // AJAXでサーバーに商品IDを送信してセッションに保存
     fetch('../method/add_to_cart.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ itemId: itemId })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log("商品IDがカートに追加されました");
            
            // カートの個数を更新
            updateCartButton();
        } else {
            console.error("カートへの追加に失敗しました: " + data.error);
        }
    })
    .catch(error => console.error("通信エラー: ", error));
}

// カートボタンの個数を更新する関数
function updateCartButton() {
    fetch('../method/get_cart_count.php') // サーバーからカート個数を取得
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // カートボタン内のテキストを更新
                const cartButton = document.querySelector('.cart-button');
                cartButton.innerHTML = `🛒 ${data.count}`;
            } else {
                console.error("カート個数の取得に失敗しました: " + data.error);
            }
        })
        .catch(error => console.error("通信エラー: ", error));
}