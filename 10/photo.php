<?php
//Сценарий отправки файла на сервер
//Проверяем, была ли выполнена отправка файла. Далее реализуем
//сценарий.
if (isset($_POST["MAX_FILE_SIZE"])) {
    $tmp_file_name = $_FILES["file_upload"]["tmp_name"];
    $dest_file_name = __DIR__ . "/photo/" . $_FILES["file_upload"]["name"];
    move_uploaded_file($tmp_file_name, $dest_file_name);
}

//Сценарий удаления файла
//Сначала проверяем, было ли запущено удаление файла
if (isset($_POST["file_delete"])) {
    //Формируем полное имя файла
    $file_name = __DIR__ . "/photo/" . $_POST["file_delete"];
    //Функция unlink() удаляет файл
    unlink($file_name);
}

//Получаем полный путь к папке, где хранятся графические файлы
$image_dir_path = __DIR__ . "/photo";
//Запускаем просмотр папки. Функция opendir() возвращает идентификатор
//папки
$image_dir_id = opendir($image_dir_path);
//$array_files - массив, в который будут помещаться все найденные файлы
$array_files = array();
//Служебная переменная, используемая для вычисления индекса
//следующего элемента массива $array_files
$i = 0;
//Запускаем цикл просмотра
while (($path_to_file = readdir($image_dir_id)) !== false) {
    //Функция readdir() возвращает имя очередного файла
    if (($path_to_file != ".") && ($path_to_file != "..")) {
        $array_files[$i] = basename($path_to_file);
        $i++;
        //Помещаем имя найденного файла в массив $array_files.
    }
}
closedir($image_dir_id);
//closedir() удаляет из памяти переданный ей идентификатор папки
$array_files_count = count($array_files);
?>
<html>
<head>
<title>Фото</title>
</head>
<body>
<p>Список изображений на сайте:</p>
<?php
if ($array_files_count) {
?>
<hr />
        <?php
sort($array_files);
for ($i = 0; $i < $array_files_count; $i++) {
    //Выводим имена хранящихся в массиве файлов на страницу
?>
<p><a href="photo/<?php echo $array_files[$i]; ?>"
target="_blank">
<?php echo $array_files[$i]; ?></a></p>
<?php
}
?>
<hr />
        <?php
}
?>

<!-- Форма для отправки файла на сервер -->
<form name="file_upload" action="photo.php"
enctype="multipart/form-data" method="post">
<input type="hidden" name="MAX_FILE_SIZE" value="5242880" />
<input type="file" name="file_upload" />
<input type="submit" name="submit" value="Добавить" />
</form>

<!-- Форма для удаления файла с сервера -->
<form name="file_delete" action="photo.php" method="post"
enctype="application/x-www-form-urlencoded">
Файл <select name="file_delete" size="1">
<?php for ($i = 0; $i < $array_files_count; $i++) { ?>
<option><?php echo $array_files[$i]; ?></option>
<?php } ?></select>
<input type="submit" name="submit" value="Удалить" />
</form>

<p><a href="blog.php">Возврат на главную страницу сайта</a></p>
</body>
</html>
