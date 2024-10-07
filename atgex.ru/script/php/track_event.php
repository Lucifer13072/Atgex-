<?php
$servername = "localhost";
$username = "atgex-admin";
$password = "YX3jv2r6KBkuKX9";
$dbname = "atgex";

// Создание соединения
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Создаем таблицу user_activity, если она не существует
$sql_create_table = "
CREATE TABLE IF NOT EXISTS user_activity (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    activity_type ENUM('visit', 'purchase', 'registration', 'bounce'),
    activity_date DATE
)";
$conn->query($sql_create_table);

// Получение данных из POST запроса
$data = json_decode(file_get_contents('php://input'), true);
$event = $data['event'];
$timestamp = $data['timestamp']; // Ожидаем формат YYYY-MM-DD

// Вставка данных в таблицу user_activity
$sql_insert = "INSERT INTO user_activity (user_id, activity_type, activity_date)
VALUES (0, '$event', '$timestamp')"; // user_id = 0, если нет авторизации

if ($conn->query($sql_insert) === TRUE) {
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode(["status" => "error", "message" => $conn->error]);
}

$conn->close();
?>
