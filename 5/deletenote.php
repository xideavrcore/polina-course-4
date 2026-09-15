<?php
require_once ("connections/MySiteDB.php");
$select_db = mysqli_select_db($link, $db);

$note_id = $_GET['note'];

$query_comments = "DELETE FROM comments WHERE art_id = $note_id";
mysqli_query($link, $query_comments);

$query = "DELETE FROM notes WHERE id = $note_id";
$result = mysqli_query($link, $query);

if ($result) {
    echo "Заметка удалена", "<br>";
} else {
    echo "Заметка не удалена", "<br>";
}
?>
<a href="blog.php">Вернуться на главную страницу сайта</a>
