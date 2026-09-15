<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_Dreamweaver = getenv('MYSQL_HOST') ?: 'localhost';
$database_Dreamweaver = "MySiteDB";
$username_Dreamweaver = "admin";
$password_Dreamweaver = "admin";
$Dreamweaver = mysqli_connect($hostname_Dreamweaver, $username_Dreamweaver, $password_Dreamweaver, $database_Dreamweaver) or
    trigger_error(mysqli_connect_error(), E_USER_ERROR);

mysqli_query($Dreamweaver, "SET NAMES utf8mb4;") or die(mysqli_error($Dreamweaver));
mysqli_query($Dreamweaver, "SET CHARACTER SET utf8mb4;") or die(mysqli_error($Dreamweaver));
?>
