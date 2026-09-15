<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>MyTravelNotes - комментарии</title>
</head>
<body>
<?php require_once ("connections/MySiteDB.php"); ?>

<?php
mysqli_select_db($link, $db);

//Переменной $note_id необходимо присвоить id заметки, переданной
//с помощью метода $_GET со страницы blog.php
$note_id = $_GET['note'];

//Формируем SQL-запрос на выборку с учетом переданного id заметки
$query = "SELECT created, title, article FROM notes WHERE id = $note_id";
$select_note = mysqli_query($link, $query);
$note = mysqli_fetch_array($select_note);

echo $note['created'], "<br>";
echo $note['title'], "<br>";
echo $note['article'], "<br>";
?>
<p>
<a href="editnote.php?note=<?php echo $note_id; ?>">Исправить заметку</a>
|
<a href="deletenote.php?note=<?php echo $note_id; ?>">Удалить заметку</a>
</p>
<?php
echo "<hr>";

$query_comments = "SELECT * FROM comments WHERE art_id = $note_id";
$select_comments = mysqli_query($link, $query_comments);
$num = mysqli_num_rows($select_comments);

if ($num > 0) {
    while ($comment = mysqli_fetch_array($select_comments)) {
        echo $comment['id'], "<br>";
        echo $comment['created'], "<br>";
        echo $comment['author'], "<br>";
        echo $comment['comment'], "<br>";
        echo "<br>";
    }
} else {
    echo "Эту запись еще никто не комментировал";
}
?>
</body>
</html>
