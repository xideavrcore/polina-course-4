<?php
//Сценарий отправки файла на сервер
if (isset($_POST["MAX_FILE_SIZE"])) {
    $tmp_file_name = $_FILES["file_upload"]["tmp_name"];
    $dest_file_name = __DIR__ . "/files/" . $_FILES["file_upload"]["name"];
    move_uploaded_file($tmp_file_name, $dest_file_name);
}

//Сценарий удаления файла
if (isset($_POST["file_delete"])) {
    $file_name = __DIR__ . "/files/" . $_POST["file_delete"];
    unlink($file_name);
}

$image_dir_path = __DIR__ . "/files";
$image_dir_id = opendir($image_dir_path);
$array_files = array();
$i = 0;
while (($path_to_file = readdir($image_dir_id)) !== false) {
    if (($path_to_file != ".") && ($path_to_file != "..")) {
        $array_files[$i] = basename($path_to_file);
        $i++;
    }
}
closedir($image_dir_id);
$array_files_count = count($array_files);
?>
<html>
<head>
<title>Файлы</title>
</head>
<body>
<p>Список файлов на сайте:</p>
<?php
if ($array_files_count) {
?>
<hr />
        <?php
sort($array_files);
for ($i = 0; $i < $array_files_count; $i++) {
?>
<p><?php echo $array_files[$i]; ?></p>
<?php
}
?>
<hr />
        <?php
}
?>

<!-- Форма для отправки файла на сервер -->
<form name="file_upload" action="files.php"
enctype="multipart/form-data" method="post">
<input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
<input type="file" name="file_upload" />
<input type="submit" name="submit" value="Добавить" />
</form>

<!-- Форма для удаления файла с сервера -->
<form name="file_delete" action="files.php" method="post"
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
