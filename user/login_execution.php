<?php
session_start();

// カートからのログインの場合、カートに遷移
$url = 'index.php';
if(isset($_SESSION['fromCart']) && $_SESSION['fromCart']){
    unset($_SESSION['fromCart']);
    $url = 'cart.php';
}

// 完成

$pdo=new PDO('mysql:host=mysql311.phy.lolipop.lan;
            dbname=LAA1557203-boooook;charset=utf8',
            'LAA1557203',
            'boooook');
            
            $sql = $pdo->prepare('SELECT * FROM user WHERE mail_address = ? AND user_pass = ?');
            $sql->execute([$_POST['mail'],$_POST['password']]);

            if($sql->rowCount() != 0 ){
                foreach($sql as $s){
                    $_SESSION['user_id'] = $s['user_id'];
                    $_SESSION['user_name'] = $s['name'];
                }
                header('Location: '.$url.'?login=true');
                exit();
            }else{
                header('Location: login.php?error=true');
                exit();
            }
?>