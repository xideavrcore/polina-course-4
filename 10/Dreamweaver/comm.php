<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once("../connections/Dreamweaver.php");

$note_id = 0;
if (isset($_GET['note'])) {
    $note_id = (int)$_GET['note'];
}

$query_notes = "SELECT * FROM notes WHERE id = $note_id";
$notes = mysqli_query($Dreamweaver, $query_notes) or die(mysqli_error($Dreamweaver));
$row_notes = mysqli_fetch_assoc($notes);

$query_comments = "SELECT * FROM comments WHERE art_id = $note_id";
$comments = mysqli_query($Dreamweaver, $query_comments) or die(mysqli_error($Dreamweaver));
$row_comments = mysqli_fetch_assoc($comments);
$totalRows_comments = mysqli_num_rows($comments);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>MyTravelNotes - комментарии</title>
</head>
<body>
<p>Комментируемая заметка:</p>
<?php if ($row_notes) { ?>
    <?php echo $row_notes['created']; ?><br>
    <?php echo $row_notes['title']; ?><br>
    <?php echo $row_notes['article']; ?><br>
<?php } ?>
<hr>
<p>Комментарии:</p>
<?php if ($totalRows_comments > 0) { ?>
<?php do { ?>
    <?php echo $row_comments['created']; ?><br>
    <?php echo $row_comments['author']; ?><br>
    <?php echo $row_comments['comment']; ?><br><br>
<?php } while ($row_comments = mysqli_fetch_assoc($comments)); ?>
<?php } else { ?>
Эту запись еще никто не комментировал
<?php } ?>
<p><a href="main.php">На главную (main.php)</a></p>
</body>
</html>
<?php
mysqli_free_result($notes);
mysqli_free_result($comments);
?>
