<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    <?php
    $pdo=new PDO('mysql:host=mysql311.phy.lolipop.lan;
    dbname=LAA1557217-boooook;charset=utf8',
    'LAA1557217',
    'boooook');

    $name=$_POST['name'];
    $mail=$_POST['mail'];
    $password1=$_POST['password1'];
    $password2=$_POST['password2'];
    $postcord=$_POST['postcord'];
    $address=$_POST['address'];

    if (empty($name) || empty($mail) || empty($password1) || empty($password2) || empty($postcode) || empty($address)) {
        header('Location: register.php?error1=true');
        exit();
    }
    if ($password1 !== $password2) {
        header('Location: register.php?error2=true');
        exit();
    }


    $sql=$pdo->prepare('INSERT INTO user(name,mail,password1,postcord,address)VALUES(?,?,?,?,?)');
    $sql->execute([$name,$mail,$password1,$postcord,$address]);
    $pdo=null;
    header('Location: login.php');
        exit();
    ?>
</body>
</html>