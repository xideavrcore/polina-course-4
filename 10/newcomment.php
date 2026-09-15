<html>
<head>
<title>Страница для добавления комментария</title>
</head>
<body>
<?php
$note_id = $_GET['note'];
require_once ("connections/MySiteDB.php");
$select_db = mysqli_select_db($link, $db);
?>
<p>Добавить комментарий к заметке: </p>
<form id="newcomment" name="newcomment" method="post" action="">
Автор<br>
<input type="text" name="author" id="author" size="20" maxlength="20"/><br>
Комментарий<br>
<textarea name="comment" cols="55" rows="10" id="comment"></textarea>
<input type="hidden" name="created" id="created"
value="<?php echo date("Y-m-d");?>"/>
<input type="hidden" name="art_id" id="art_id"
value="<?php echo $note_id;?>"/>
<input type="submit" name="submit" id="submit" value="Отправить" />
</form>
<a href="comments.php?note=<?php echo $note_id; ?>">Вернуться к комментариям</a>
<br>
<a href="blog.php">Возврат на главную страницу сайта</a>
<?php
if (isset($_POST['submit'])) {
    $author = $_POST['author'];
    $comment = $_POST['comment'];
    $created = $_POST['created'];
    $art_id = $_POST['art_id'];
    if (($author) && ($comment) && ($created) && ($art_id)) {
        $query = "INSERT INTO comments (created, author, comment, art_id)
VALUES ('$created', '$author', '$comment', '$art_id')";
        $result = mysqli_query($link, $query);
    }
}
?>
</body>
</html>
