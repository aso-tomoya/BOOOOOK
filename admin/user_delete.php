<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
ob_start();
    if(isset($_POST['check'])){
        $ids = $_POST['check'];
        $pdo=new PDO('mysql:host=mysql311.phy.lolipop.lan;
        dbname=LAA1557203-boooook;charset=utf8',
        'LAA1557203',
        'boooook');
        $sql='DELETE FROM user WHERE user_id in (' . implode(',', array_map('intval', $ids)) . ')';
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        header('Location: manage_users.php');
        exit();
    }else{
        header('Location: manage_users.php?error=true');
        exit();
    }
    ob_end_flush(); 
    $pdo=null;
    ?>
</body>
</html>