<header>

<?php 
// データベースアクセス
$db=new PDO('mysql:host=mysql311.phy.lolipop.lan;
            dbname=LAA1557203-boooook;charset=utf8',
            'LAA1557203',
            'boooook');

#ジャンルを取得
include_once ('method/itemGet.php');
$genres=getAllGenre($db);
?>

<!-- タイトルロゴ -->
    <h1><a href="index.php" class="link"><img src="../img/BOOOOOK.png" alt="BOOOOOK" width="200"></a></h1>

<!-- 検索バー -->
    <!-- 表示するページ判定 -->
    <?php if(!(strpos($_SERVER['PHP_SELF'], '/admin/') || strpos($_SERVER['PHP_SELF'], '/checkout') || strpos($_SERVER['PHP_SELF'], '/change_address') || strpos($_SERVER['PHP_SELF'], '/manage_payment') || strpos($_SERVER['PHP_SELF'], '/login') || strpos($_SERVER['PHP_SELF'], '/register') || strpos($_SERVER['PHP_SELF'], '/edit_profile'))): ?>
        <form action="search_results.php" method="get">
            <div class="search-bar">
                    <input type="text" name="searchWord" placeholder="商品を検索" id="input-search">
                    <input type="submit" value="🔍">
            </div>
            <!-- ジャンル検索のドロップダウンリスト -->
            <div id="genre-dropdown" class="dropdown hidden">
                <ul>
                    <?php foreach ($genres as $genre): ?>
                        <li>
                            <a href="search_results.php?genre=<?= $genre['genre_id']; ?>">
                                <?=$genre['genre_name']; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </form>
    <?php endif; ?>

<!-- 各種ボタンコンテナ -->
<!-- 管理者は表示なし -->
    <?php if(!strpos($_SERVER['PHP_SELF'], '/admin/')): ?>
        <div class="header-container">

<!-- ログインボタン -->
    <!-- 表示するページ判定 -->
        <?php if(!(strpos($_SERVER['PHP_SELF'], '/checkout') || strpos($_SERVER['PHP_SELF'], '/change_address') || strpos($_SERVER['PHP_SELF'], 'manage_payment') || strpos($_SERVER['PHP_SELF'], '/login') || strpos($_SERVER['PHP_SELF'], '/register') || strpos($_SERVER['PHP_SELF'], '/edit_profile') || strpos($_SERVER['PHP_SELF'], '/mypage'))): ?>

        <!-- ログイン判定 -->
            <?php if(isset($_SESSION['user_id'])): ?>
                <a href="mypage.php" class="link">
                    <button class="login-button">マイページ</button>
                </a>

        <!-- 未ログイン -->
            <?php else: ?>
                <a href="login.php" class="link">
                    <button class="login-button">ログイン</button>
                </a>
            <?php endif; ?>

<!-- カートボタン -->
<!-- 表示するページ判定 -->
            <?php if(!(strpos($_SERVER['PHP_SELF'], '/checkout') || strpos($_SERVER['PHP_SELF'], '/change_address') || strpos($_SERVER['PHP_SELF'], 'manage_payment') || strpos($_SERVER['PHP_SELF'], '/login') || strpos($_SERVER['PHP_SELF'], '/register') || strpos($_SERVER['PHP_SELF'], '/edit_profile') || strpos($_SERVER['PHP_SELF'], '/cart'))): ?>
                <a href="cart.php">
                    <button class="cart-button">🛒
                        <!-- カートの中身の個数を表示 -->
                        <?php
                        if (isset($_SESSION['cart'])) {
                            echo count($_SESSION['cart']);
                        } else {
                            echo '0';
                        }
                        ?>
                    </button>
                </a>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    <?php endif; ?>
</header>