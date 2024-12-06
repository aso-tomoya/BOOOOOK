<?php
session_start();

// 完成

$pdo=new PDO('mysql:host=mysql311.phy.lolipop.lan;
            dbname=LAA1557203-boooook;charset=utf8',
            'LAA1557203',
            'boooook');
            
            $sql = $pdo->prepare('SELECT * FROM admin WHERE admin_id = ? AND admin_pass = ?');
            $sql->execute([$_POST['admin_id'],$_POST['admin_pass']]);

            if($sql->rowCount() != 0 ){
                foreach($sql as $s){
                    $_SESSION['admin_id'] = $s['admin_id'];
                    $_SESSION['admin_pass'] = $s['admin_pass'];
                }
                header('Location: index.php');
                exit();
            }else{
                header('Location: login.php?error=true');
                exit();
            }
?>