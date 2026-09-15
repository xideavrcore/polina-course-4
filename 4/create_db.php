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

//Создать БД MySiteDB
$db = "MySiteDB";
$query = "CREATE DATABASE $db";
$create_db = mysqli_query($link, $query);
if ($create_db) {
    echo "  База данных $db успешно создана";
} else {
    echo "База не создана";
}
?>
