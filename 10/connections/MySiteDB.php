<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$localhost = getenv('MYSQL_HOST') ?: 'localhost';
$db = "MySiteDB";
$user = "admin";
$password = "admin";
$link = mysqli_connect($localhost, $user, $password) or
    trigger_error(mysqli_connect_error(), E_USER_ERROR);

mysqli_query($link, "SET NAMES utf8mb4;") or die(mysqli_error($link));
mysqli_query($link, "SET CHARACTER SET utf8mb4;") or die(mysqli_error($link));
?>
