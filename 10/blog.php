<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>MyTravelNotes - блог</title>
</head>
<body>
    <div style="border: 1px solid #999; padding: 6px;">
        <a href="Dreamweaver/login.php">Войти</a> |
        <a href="newnote.php">Новая запись</a> |
        <a href="email.php">Отправить сообщение</a> |
        <a href="photo.php">Фото</a> |
        <a href="files.php">Файлы</a> |
        <a href="Dreamweaver/users.php">Администратору</a> |
        <a href="inform.php">Информация</a> |
        <a href="Dreamweaver/logout.php">Выйти</a>
    </div>
    <p><em>Рад приветствовать вас<br>
    на страницах моего сайта, посвященного путешествиям!<br>
    Здесь я буду рассказывать о своих путешествиях...<br>
    .... и выкладывать разные интересные материалы!</em></p>

<form method="get" action="blog.php">
Поиск:
<input type="text" name="usersearch" size="40"
value="<?php if (!empty($_GET['usersearch'])) echo $_GET['usersearch']; ?>" />
<input type="submit" value="Найти" />
</form>
<br>

<?php require_once ("connections/MySiteDB.php"); ?>

<?php
mysqli_select_db($link, $db);

$user_search = '';
if (isset($_GET['usersearch'])) {
    $user_search = $_GET['usersearch'];
}

if (!empty($user_search)) {
    //Поиск по фразе (по содержанию заметки)
    $where_list = array();
    $query_usersearch = "SELECT * FROM notes";
    $clean_search = str_replace(',', ' ', $user_search);
    $search_words = explode(' ', $clean_search);
    //Создаем еще один массив с окончательными результатами
    $final_search_words = array();
    //Проходим в цикле по каждому элементу массива $search_words.
    //Каждый непустой элемент добавляем в массив $final_search_words
    if (count($search_words) > 0) {
        foreach ($search_words as $word) {
            if (!empty($word)) {
                $final_search_words[] = $word;
            }
        }
    }
    //работа с использованием массива $final_search_words
    foreach ($final_search_words as $word) {
        $where_list[] = " article LIKE '%$word%'";
    }
    $where_clause = implode(' OR ', $where_list);
    if (!empty($where_clause)) {
        $query_usersearch .= " WHERE $where_clause";
    }
    $res_query = mysqli_query($link, $query_usersearch);
    while ($res_array = mysqli_fetch_array($res_query)) {
        echo $res_array['id'], "<br>";
?>
<a href="comments.php?note=<?php echo $res_array['id']; ?>">
<?php echo $res_array['title'], "<br>"; ?></a>
<?php
        echo $res_array['article'], "<br>", "<hr>", "<br>";
    }
} else {
    $query = "SELECT * FROM notes ORDER BY id DESC";
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
}
?>
</body>
</html>
