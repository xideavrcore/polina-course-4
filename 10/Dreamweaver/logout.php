<?php
if (!isset($_SESSION)) {
    session_start();
}

if ((isset($_GET['doLogout'])) && ($_GET['doLogout'] == "true")) {
    $_SESSION['MM_Username'] = NULL;
    $_SESSION['MM_UserGroup'] = NULL;
    unset($_SESSION['MM_Username']);
    unset($_SESSION['MM_UserGroup']);
    $logoutGoTo = "main.php";
    header("Location: $logoutGoTo");
    exit;
}
?>
<html>
<head>
<title>Выход</title>
</head>
<body>
<p>Выход с сайта</p>
<p>Нажмите «Выход», чтобы завершить сеанс, или вернитесь на главную, оставаясь в системе.</p>
<p><a href="logout.php?doLogout=true">Выход</a></p>
<p><a href="main.php">Вернуться на главную страницу</a></p>
</body>
</html>
