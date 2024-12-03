<?php
// ログイン中のユーザー情報をすべて取得
function getUser($db, $id)
{
    $sql = $db->prepare('SELECT * FROM user where user_id = ?');
    $sql->execute([$id]);
    return $sql->fetch(PDO::FETCH_ASSOC);
}