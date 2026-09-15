<?php
mysqli_report(MYSQLI_REPORT_OFF);

//Соединение с сервером
$link = mysqli_connect(getenv('MYSQL_HOST') ?: 'localhost', 'admin', 'admin');

//Выбор БД
$db = "MySiteDB";
$select = mysqli_select_db($link, $db);
if ($select) {
    echo "  База успешно выбрана", "<br>";
} else {
    echo "База не выбрана", "<br>";
}

//Создание таблицы comments (упр. 4)
$query = "CREATE TABLE comments
(id SMALLINT NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (id),
  created DATE NOT NULL,
  author VARCHAR (20) NOT NULL,
  comment VARCHAR (255) NOT NULL,
  art_id INT NOT NULL)";

$create_tbl = mysqli_query($link, $query);
if ($create_tbl) {
    echo " Таблица comments успешно создана", "<br>";
} else {
    echo "Таблица comments не создана", "<br>";
}

//Связь comments.art_id -> notes.id (упр. 5)
$query = "ALTER TABLE comments
  ADD CONSTRAINT fk_comments_notes
  FOREIGN KEY (art_id) REFERENCES notes(id)";

$fk = mysqli_query($link, $query);
if ($fk) {
    echo " Связь между таблицами создана", "<br>";
} else {
    echo "Связь не создана", "<br>";
}

//Тестовые записи (упр. 5, Insert)
$notes_count = 0;
$res = mysqli_query($link, "SELECT COUNT(*) AS c FROM notes");
if ($res) {
    $row = mysqli_fetch_array($res);
    $notes_count = (int)$row['c'];
}

if ($notes_count == 0) {
    $ok = mysqli_query($link, "INSERT INTO notes (created, title, article) VALUES
('2026-03-01', 'Paris', 'First trip to Paris in spring.'),
('2026-03-10', 'Rome', 'Colosseum and good coffee.'),
('2026-04-05', 'Berlin', 'Museums and parks.')");
    if ($ok) {
        echo " Записи в notes добавлены", "<br>";
    } else {
        echo "Записи в notes не добавлены", "<br>";
    }
} else {
    echo " В notes уже есть записи, пропуск вставки", "<br>";
}

$comments_count = 0;
$res = mysqli_query($link, "SELECT COUNT(*) AS c FROM comments");
if ($res) {
    $row = mysqli_fetch_array($res);
    $comments_count = (int)$row['c'];
}

if ($comments_count == 0) {
    $ok = mysqli_query($link, "INSERT INTO comments (created, author, comment, art_id) VALUES
('2026-03-02', 'Anna', 'Very interesting!', 1),
('2026-03-11', 'Igor', 'Want to visit Rome', 2),
('2026-03-12', 'Maria', 'Thanks for the story', 2),
('2026-04-06', 'Petr', 'Looking forward', 3)");
    if ($ok) {
        echo " Записи в comments добавлены", "<br>";
    } else {
        echo "Записи в comments не добавлены", "<br>";
    }
} else {
    echo " В comments уже есть записи, пропуск вставки", "<br>";
}

//Таблица privileges (лаба 10)
$query = "CREATE TABLE privileges
(id SMALLINT NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (id),
  name VARCHAR (20),
  password VARCHAR (20),
  rights VARCHAR (1))";
$create_priv = mysqli_query($link, $query);
if ($create_priv) {
    echo " Таблица privileges успешно создана", "<br>";
} else {
    echo "Таблица privileges не создана", "<br>";
}

$priv_count = 0;
$res = mysqli_query($link, "SELECT COUNT(*) AS c FROM privileges");
if ($res) {
    $row = mysqli_fetch_array($res);
    $priv_count = (int)$row['c'];
}
if ($priv_count == 0) {
    $ok = mysqli_query($link, "INSERT INTO privileges (name, password, rights) VALUES
('admin', 'admin', 'a'),
('user1', 'user1', 'u'),
('user2', 'user2', 'u')");
    if ($ok) {
        echo " Записи в privileges добавлены", "<br>";
    } else {
        echo "Записи в privileges не добавлены", "<br>";
    }
} else {
    echo " В privileges уже есть записи, пропуск вставки", "<br>";
}

echo "<br>ВНИМАНИЕ, ПОСЛЕ ВЫПОЛНЕНИЯ ЭТОГО СКРИПТА ПЕРЕД СДАЧЕЙ ЛАБЫ НУЖНО ЕГО УДАЛИТЬ!!!!";
?>
