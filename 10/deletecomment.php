<?php
$comment_id = $_GET['comment'];
$note_id = $_GET['note'];
require_once ("connections/MySiteDB.php");
$select_db = mysqli_select_db($link, $db);

$query = "SELECT * FROM comments WHERE id = $comment_id";
$result = mysqli_query($link, $query);
$delete_comment = mysqli_fetch_array($result);
?>
<html>
<body>
<p>Страница удаления комментария </p>
<form id="deletecomment" name="deletecomment" method="post">
Автор<br>
<input type="text" name="author" id="author"
value="<?php echo $delete_comment['author'];?>" /><br>
Комментарий<br>
<input type="text" name="comment_text" id="comment_text"
value="<?php echo $delete_comment['comment'];?>" />
<input type="submit" name="submit" id="submit" value="Удалить" />
</form>
<a href="comments.php?note=<?php echo $note_id; ?>">Вернуться к комментариям</a>
<br>
<a href="blog.php">Вернуться на главную страницу сайта</a>
<?php
if (isset($_POST['submit'])) {
    $delete_query = "DELETE FROM comments WHERE id = $comment_id";
    $delete_result = mysqli_query($link, $delete_query);
    if ($delete_result) {
        echo "<p>Комментарий удален</p>";
    }
}
?>
</body>
</html>
