<?php
require_once '../db_config.php';
$id = base64_decode($_GET['id']);
mysqli_query($conn, "UPDATE `user` SET `status` = '0' WHERE `id` = '$id'");
header('Location: userlist.php');
exit;
?>