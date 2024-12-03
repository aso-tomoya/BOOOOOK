<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>ユーザー管理</title>
    
</head>

<body>

<?php include_once '../header.php' ;

$pdo=new PDO('mysql:host=mysql311.phy.lolipop.lan;
dbname=LAA1557203-boooook;charset=utf8',
'LAA1557203',
'boooook');
?>
<form action="user_delete.php" method="post">
<input type="submit" value="削除確認">

<?php
if(isset($_GET['error'])){
    echo '<p style="color:red" >削除できませんでした';
}
    echo '<table border="1" style="border-collapse: collapse">';
    echo '<tr>';
    echo '<th></th>';
    echo '<th>氏名</th>';
    echo '<th>住所</th>';
    echo '<th>メールアドレス</th>';
    echo '<th>支払方法</th>';
    echo '</tr>';
    foreach($pdo->query('select * from user') as $row){
    echo '<tr>';
    echo '<td><input type="checkbox" name="check[]" value="' . $row['user_id'] . '"></td>';
    echo '<td>',$row['name'],'</td>';
    echo '<td>',$row['address'],'</td>';
    echo '<td>',$row['mail_address'],'</td>';
    echo '<td>',$row['pay_id'],'</td>';
    echo '</tr>';
    }
    echo '</table>';
echo '</form>';
$pdo = null;
?>


</body>
</html>
