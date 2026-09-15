<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>MyTravelNotes - сообщение</title>
</head>
<body>
<p>Отправка сообщения:</p>
<form id="email" name="email" method="post" action="">
Тема сообщения<br>
<input type="text" name="subject" id="subject" size="40" /><br>
Текст сообщения<br>
<textarea name="message" id="message" cols="55" rows="10"></textarea><br>
<input type="submit" name="submit" id="submit" value="Отправить" />
</form>
<a href="blog.php">Возврат на главную страницу сайта</a>

<?php
if (isset($_POST['submit'])) {
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    if (($subject) && ($message)) {
        mail("admin@localhost", $subject, $message);
        echo "<p>Сообщение отправлено</p>";
    } else {
        echo "<p>Заполните все поля формы</p>";
    }
}
?>
</body>
</html>
