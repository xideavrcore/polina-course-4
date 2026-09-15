<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once("../connections/Dreamweaver.php");

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_POST['name'])) {
    $loginUsername = $_POST['name'];
    $password = $_POST['password'];
    $MM_fldUserAuthorization = "rights";
    $MM_redirectLoginSuccess = "main.php";
    $MM_redirectLoginFailed = "main.php";

    $LoginRS__query = "SELECT name, password, rights FROM privileges WHERE name='$loginUsername' AND password='$password'";
    $LoginRS = mysqli_query($Dreamweaver, $LoginRS__query) or die(mysqli_error($Dreamweaver));
    $loginFoundUser = mysqli_num_rows($LoginRS);
    if ($loginFoundUser) {
        $loginStrGroup = "";
        if (true) {
            $row = mysqli_fetch_assoc($LoginRS);
            $loginStrGroup = $row['rights'];
        }
        $_SESSION['MM_Username'] = $loginUsername;
        $_SESSION['MM_UserGroup'] = $loginStrGroup;
        header("Location: " . $MM_redirectLoginSuccess);
        exit;
    } else {
        header("Location: " . $MM_redirectLoginFailed);
        exit;
    }
}
?>
<html>
<head>
<title>Вход</title>
</head>
<body>
<p>Вход на сайт:</p>
<form id="login" name="login" method="post" action="<?php echo $loginFormAction; ?>">
Имя<br>
<input type="text" name="name" id="name" size="20" maxlength="20" /><br>
Пароль<br>
<input type="password" name="password" id="password" size="20" maxlength="20" /><br>
<input type="submit" name="submit" id="submit" value="Войти" />
</form>
<p><a href="main.php">На главную (main.php)</a></p>
</body>
</html>
