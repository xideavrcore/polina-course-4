<?php
if (!isset($_SESSION)) {
    session_start();
}

$MM_authorizedUsers = "a";
$MM_donotCheckaccess = "false";

function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) {
    $isValid = false;
    if (!empty($UserName)) {
        $arrUsers = Explode(",", $strUsers);
        $arrGroups = Explode(",", $strGroups);
        if (in_array($UserName, $arrUsers)) {
            $isValid = true;
        }
        if (in_array($UserGroup, $arrGroups)) {
            $isValid = true;
        }
        if (($strUsers == "") && false) {
            $isValid = true;
        }
    }
    return $isValid;
}

$MM_restrictGoTo = "rights.html";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("", $MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {
    header("Location: ". $MM_restrictGoTo);
    exit;
}

require_once("../connections/Dreamweaver.php");

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $password = $_POST['password'];
    $rights = $_POST['rights'];
    if (($name) && ($password) && ($rights)) {
        $insertSQL = "INSERT INTO privileges (name, password, rights) VALUES ('$name', '$password', '$rights')";
        mysqli_query($Dreamweaver, $insertSQL) or die(mysqli_error($Dreamweaver));
        header("Location: users.php");
        exit;
    }
}
?>
<html>
<head>
<title>Добавление пользователя</title>
</head>
<body>
<p>Добавить пользователя:</p>
<form id="adduser" name="adduser" method="post" action="">
Имя<br>
<input type="text" name="name" id="name" size="20" maxlength="20" /><br>
Пароль<br>
<input type="text" name="password" id="password" size="20" maxlength="20" /><br>
Права (a/u)<br>
<input type="text" name="rights" id="rights" size="1" maxlength="1" /><br>
<input type="submit" name="submit" id="submit" value="Добавить" />
</form>
<p><a href="users.php">К списку пользователей</a></p>
<p><a href="main.php">На главную (main.php)</a></p>
</body>
</html>
