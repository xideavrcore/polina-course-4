<?php
mysqli_report(MYSQLI_REPORT_OFF);

//Создать соединение с сервером
$link = mysqli_connect(
    getenv('MYSQL_HOST') ?: 'localhost',
    getenv('MYSQL_USER') ?: 'root',
    getenv('MYSQL_PASSWORD') ?: ''
);
if ($link) {
    echo " Соединение с сервером установлено", "<br>";
} else {
    echo "Нет соединения с сервером";
}

//Сформировать SQL-запрос на создание нового пользователя базы данных
$query = "GRANT ALL PRIVILEGES ON *.* TO 'admin'@'localhost'
IDENTIFIED BY 'admin'
  WITH GRANT OPTION";

//Реализовать запрос
$create_user = mysqli_query($link, $query);
if ($create_user) {
    echo "Пользователь admin успешно создан";
} else {
    echo "Пользователь не создан";
}
?>
