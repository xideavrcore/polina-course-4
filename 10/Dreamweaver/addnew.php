<?php
if (!isset($_SESSION)) {
    session_start();
}

$MM_authorizedUsers = "a,u";
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

$MM_restrictGoTo = "login.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("", $MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {
    header("Location: ". $MM_restrictGoTo);
    exit;
}

require_once("../connections/Dreamweaver.php");

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $article = $_POST['article'];
    $created = $_POST['created'];
    if (($title) && ($article) && ($created)) {
        $insertSQL = "INSERT INTO notes (title, created, article) VALUES ('$title', '$created', '$article')";
        mysqli_query($Dreamweaver, $insertSQL) or die(mysqli_error($Dreamweaver));
        header("Location: main.php");
        exit;
    }
}
?>
<html>
<head>
<title>Добавление заметки</title>
</head>
<body>
<p>Добавить новую заметку:</p>
<form id="addnote" name="addnote" method="post" action="">
Заголовок<br>
<input type="text" name="title" id="title" size="20" maxlength="20" /><br>
Содержание<br>
<textarea name="article" id="article" cols="50" rows="5"></textarea>
<input type="hidden" name="created" id="created" value="<?php echo date("Y-m-d"); ?>" />
<input type="submit" name="submit" id="submit" value="Отправить" />
</form>
<p><a href="main.php">На главную (main.php)</a></p>
</body>
</html>
