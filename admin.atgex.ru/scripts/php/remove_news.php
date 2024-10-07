<?php
// Подключение к базе данных
$servername = "localhost";
$username = "atgex-admin";
$password = "YX3jv2r6KBkuKX9";
$dbname = "atgex";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Получение идентификатора новости для удаления
$news_id = $_GET['id']; // Предполагается, что идентификатор передается через GET-параметр

// Формирование SQL-запроса на удаление новости
$sql = "DELETE FROM news WHERE id = $news_id";

// Выполнение запроса к базе данных
 if ($conn->query($sql) !== TRUE) {
    echo "Ошибка при удалении новости: " . $conn->error;
}

$conn->close();
?>
<script type="text/javascript">
    // Перенаправление пользователя на предыдущую страницу
    window.history.back();
</script>