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

    const button = document.querySelector(`button[onclick="addToCart('${itemId}')"]`);
    const productImage = document.querySelector(".product-image"); // 最初の1つだけ取得
    const cartButton = document.querySelector(".cart-button"); // 単一要素として取得

    if (!productImage || !cartButton) {
        console.error("商品画像またはカートボタンが見つかりません");
        return;
    }

    // 商品画像を複製してアニメーションさせる
    const clonedImage = productImage.cloneNode(true); // 子要素も含めて複製
    clonedImage.classList.add('fly-animation');
    document.body.appendChild(clonedImage);

    // カートボタンの位置を取得
    const cartRect = cartButton.getBoundingClientRect();
    const cartX = cartRect.left -150;
    const cartY = cartRect.top -150;

    // 商品画像の位置を取得
    const imageRect = productImage.getBoundingClientRect();
    const imageX = imageRect.left;
    const imageY = imageRect.top;

    // 商品画像をカートボタンに移動させる
    clonedImage.style.position = "absolute";
    clonedImage.style.left = `${imageX}px`;
    clonedImage.style.top = `${imageY}px`;
    // clonedImage.style.width = `${productImage.offsetWidth}px`;
    clonedImage.style.transition = "all 1s ease-in-out";

    // アニメーション開始
    setTimeout(() => {
        clonedImage.style.left = `${cartX}px`;
        clonedImage.style.top = `${cartY}px`;
        clonedImage.style.transform = "scale(0.1)";
        clonedImage.style.opacity = "0";
    }, 10);

    // アニメーション終了後に複製画像を削除
    clonedImage.addEventListener("transitionend", () => {
        clonedImage.remove();
    });

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