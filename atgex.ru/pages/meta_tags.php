<?php
// Параметры подключения к базе данных
$servername = "localhost";
$username = "atgex-admin";
$password = "YX3jv2r6KBkuKX9";
$dbname = "atgex";

try {
    // Подключение к базе данных
    $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    
    // Установка режима обработки ошибок
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Выполнение запроса к базе данных
    $query = "SELECT title, keywords, description FROM parametrs_site";
    $statement = $db->query($query);
    $row = $statement->fetch(PDO::FETCH_ASSOC);

    // Формирование HTML кода с использованием полученных параметров
    if ($row) {
        $title = $row['title'];
        $keywords = $row['keywords'];
        $description = $row['description'];
        
        echo '
        <meta name="keywords" content="'.$keywords.'">
        <meta name="description" content="'.$description.'">
        <title>'.$title.'</title>
        ';
    } else {
        echo "Данные не найдены в базе данных";
    }

} catch(PDOException $e) {
    // Вывод ошибки, если она произошла
    echo "Ошибка при подключении к базе данных: " . $e->getMessage();
}
?>