<?php
session_start();

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
                    $_SESSION['mail_address'] = $s['mail_address'];
                    $_SESSION['user_pass'] = $s['user_pass'];
                    $_SESSION['postal_cord'] = $s['postal_cord'];
                    $_SESSION['address'] = $s['address'];
                    $_SESSION['pay_id'] = $s['pay_id'];
                    $_SESSION['total_price'] = $s['total_price'];
                

                }
                header('Location: index.php');
                exit();
            }else{
                header('Location: login.php?error=true');
                exit();
            }
?>