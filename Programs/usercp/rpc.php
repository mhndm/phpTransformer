<?php
include_once '../../includes.php';
$ext = $_POST['e'];
$db = new db();
$db->query(" update `users` set `UserPic`='uploads/users/admin/avatar_128.".$ext."' where `NickName`='".$_SESSION['NickName']."' ;  ");
?>