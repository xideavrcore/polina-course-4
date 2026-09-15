<?php
$note_id = $_GET['note'];
require_once ("connections/MySiteDB.php");
$select_db = mysqli_select_db($link, $db);
$query = "SELECT * FROM notes WHERE id = $note_id";
$result = mysqli_query($link, $query);
$delete_note = mysqli_fetch_array($result);
?>
<html>
<body>
<p>Страница удаления заметки </p>
<form id="deletenote" name="deletenote" method="post">
<label for="title">Заголовок заметки</label>
<input type="text" name="title" id="title"
value="<?php echo $delete_note['title'];?>" />
<label for="article">Текст заметки </label>
<input type="text" name="article" id="article"
value="<?php echo $delete_note['article'];?>" />
<input type="hidden" name="note" id="note"
value="<?php echo $delete_note['id']?>" />
<input type="submit" name="submit" id="submit" value="Удалить" />
</form>
<a href="comments.php?note=<?php echo $note_id; ?>">Вернуться к комментариям</a>
<br>
<a href="blog.php">Вернуться на главную страницу сайта</a>
<?php
if (isset($_POST['submit'])) {
    $query_comments = "DELETE FROM comments WHERE art_id = $note_id";
    mysqli_query($link, $query_comments);
    $delete_query = "DELETE FROM notes WHERE id = $note_id";
    $delete_result = mysqli_query($link, $delete_query);
    if ($delete_result) {
        echo "<p>Заметка удалена</p>";
    }
}
?>
</body>
</html>
