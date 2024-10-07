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

// Получение новостей из базы данных
$sql = "SELECT * FROM news";
$result = $conn->query($sql);

// Отображение новостей
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='news-item'>"; // Начало блока каждой новости
        echo "<p class='news-title'>" . $row['title'] . "</h2>";
        echo "<hr class='liner'>";
        if (!empty($row['image'])) {
            echo "<div><img class='news-image' src='/uploads/" . $row['image'] . "' alt='Изображение новости'></div>";
        }
        echo "<p class='news-text'>" . $row['text'] . "</p>";
        echo "<a href='/../scripts/php/edit_news.php?id=" . $row['id'] . "' class='edit-link'>Редактировать</a>";
        echo "<a href='/../scripts/php/remove_news.php?id=" . $row['id'] . "' class='delete-link'>Удалить</a>"; // Ссылка для удаления новости
        echo "</div>"; // Конец блока каждой новости
    }
}
$conn->close();
?>