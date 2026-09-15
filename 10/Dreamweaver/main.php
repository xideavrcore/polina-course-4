<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>MyTravelNotes - main</title>
</head>
<body>
<div style="border: 1px solid #999; padding: 6px;">
    <a href="login.php">Вход</a> |
    <a href="addnew.php">Новая запись</a> |
    <a href="users.php">Администратору</a> |
    <a href="logout.php">Выход</a> |
    <a href="../blog.php">К blog.php</a>
</div>
<p><em>main.php - список заметок (Dreamweaver)</em></p>

<?php require_once("../connections/Dreamweaver.php"); ?>

<?php
$maxRows_notes = 10;
$pageNum_notes = 0;
if (isset($_GET['pageNum_notes'])) {
    $pageNum_notes = (int)$_GET['pageNum_notes'];
}
$startRow_notes = $pageNum_notes * $maxRows_notes;

$query_notes = "SELECT * FROM notes ORDER BY id DESC";
$query_limit_notes = "$query_notes LIMIT $startRow_notes, $maxRows_notes";
$notes = mysqli_query($Dreamweaver, $query_limit_notes) or die(mysqli_error($Dreamweaver));
$row_notes = mysqli_fetch_assoc($notes);

if (isset($_GET['totalRows_notes'])) {
    $totalRows_notes = (int)$_GET['totalRows_notes'];
} else {
    $all_notes = mysqli_query($Dreamweaver, $query_notes);
    $totalRows_notes = mysqli_num_rows($all_notes);
}
$totalPages_notes = ceil($totalRows_notes / $maxRows_notes) - 1;
if ($totalPages_notes < 0) {
    $totalPages_notes = 0;
}

$queryString_notes = "";
if (!empty($_SERVER['QUERY_STRING'])) {
    $params = explode("&", $_SERVER['QUERY_STRING']);
    $newParams = array();
    foreach ($params as $param) {
        if (stristr($param, "pageNum_notes") == false && stristr($param, "totalRows_notes") == false) {
            array_push($newParams, $param);
        }
    }
    if (count($newParams) != 0) {
        $queryString_notes = "&" . htmlentities(implode("&", $newParams));
    }
}
$queryString_notes = sprintf("&totalRows_notes=%d%s", $totalRows_notes, $queryString_notes);
?>

<?php if ($totalRows_notes > 0) { ?>
<?php do { ?>
    <?php echo $row_notes['id']; ?><br>
    <a href="comm.php?note=<?php echo $row_notes['id']; ?>">
        <?php echo $row_notes['title']; ?></a><br>
    <?php echo $row_notes['created']; ?><br>
    <?php echo $row_notes['article']; ?><br><br>
<?php } while ($row_notes = mysqli_fetch_assoc($notes)); ?>
<?php } ?>

<p>
<a href="<?php printf("%s?pageNum_notes=%d%s", $_SERVER['PHP_SELF'], 0, $queryString_notes); ?>">на главную</a>
|
<a href="<?php printf("%s?pageNum_notes=%d%s", $_SERVER['PHP_SELF'], max(0, $pageNum_notes - 1), $queryString_notes); ?>">предыдущая</a>
|
<a href="<?php printf("%s?pageNum_notes=%d%s", $_SERVER['PHP_SELF'], min($totalPages_notes, $pageNum_notes + 1), $queryString_notes); ?>">следующая</a>
|
<a href="<?php printf("%s?pageNum_notes=%d%s", $_SERVER['PHP_SELF'], $totalPages_notes, $queryString_notes); ?>">в конец</a>
</p>

<p>Заметки с
<?php echo ($totalRows_notes > 0) ? ($startRow_notes + 1) : 0; ?>
по
<?php echo min($startRow_notes + $maxRows_notes, $totalRows_notes); ?>
из
<?php echo $totalRows_notes; ?>
</p>
</body>
</html>
<?php
mysqli_free_result($notes);
?>
