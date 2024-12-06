
<?php

$pdo=new PDO('mysql:host=mysql311.phy.lolipop.lan;
            dbname=LAA1557203-boooook;charset=utf8',
            'LAA1557203',
            'boooook');

$name=$_POST['name'];
$mail=mb_convert_kana($_POST['mail'], 'an');
$postcord=mb_convert_kana($_POST['postcord'], 'an');
$address=$_POST['address'];

$existingUser = '';
// メールアドレスの重複チェック
if($_POST['beforMail'] <> $mail){
    $sql = $pdo->prepare('SELECT * FROM user WHERE mail_address = ?');
    $sql->execute([$mail]);
    $existingUser = $sql->fetch();
}

if ($existingUser) {
    header('Location: mypage.php');
    exit();
} else {
    $sql=$pdo->prepare('UPDATE user SET name=?,mail_address=?,postal_code=?,address=? WHERE user_id = ?');
    $sql->execute([$name,$mail,$postcord,$address,$_POST['user_id']]);
    $pdo=null;
    header('Location: mypage.php');
    exit();

?>