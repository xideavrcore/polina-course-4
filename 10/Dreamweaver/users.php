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

$query_users = "SELECT name, rights FROM privileges ORDER BY id";
$users = mysqli_query($Dreamweaver, $query_users) or die(mysqli_error($Dreamweaver));
$row_users = mysqli_fetch_assoc($users);
$totalRows_users = mysqli_num_rows($users);
?>
<html>
<head>
<title>Пользователи</title>
</head>
<body>
<p>Список пользователей:</p>
<table border="1" cellpadding="4">
<tr><th>Имя пользователя</th><th>Права доступа</th></tr>
<?php if ($totalRows_users > 0) { ?>
<?php do { ?>
<tr>
<td><?php echo $row_users['name']; ?></td>
<td><?php echo $row_users['rights']; ?></td>
</tr>
<?php } while ($row_users = mysqli_fetch_assoc($users)); ?>
<?php } ?>
</table>
<p><a href="adduser.php">Добавить пользователя</a></p>
<p><a href="main.php">На главную (main.php)</a></p>
</body>
</html>
<?php
mysqli_free_result($users);
?>
