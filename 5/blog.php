<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>MyTravelNotes - блог</title>
</head>
<body>
    <div style="border: 1px solid #999; padding: 6px;">
        <a href="#">Войти</a> |
        <a href="newnote.php">Новая запись</a> |
        <a href="email.php">Отправить сообщение</a> |
        <a href="#">Фото</a> |
        <a href="#">Файлы</a> |
        <a href="#">Администратору</a> |
        <a href="inform.html">Информация</a> |
        <a href="#">Выйти</a>
    </div>
    <p><em>Рад приветствовать вас<br>
    на страницах моего сайта, посвященного путешествиям!<br>
    Здесь я буду рассказывать о своих путешествиях...<br>
    .... и выкладывать разные интересные материалы!</em></p>

<?php require_once ("connections/MySiteDB.php"); ?>

<?php
mysqli_select_db($link, $db);
$query = "SELECT * FROM notes";
$select_note = mysqli_query($link, $query);

while ($note = mysqli_fetch_array($select_note)) {
    echo $note['id'], "<br>";
?>
<a href="comments.php?note=<?php echo $note['id']; ?>">
<?php echo $note['title'], "<br>"; ?></a>
<?php
    echo $note['created'], "<br>";
    echo $note['article'], "<br>";
}
?>
</body>
</html>
