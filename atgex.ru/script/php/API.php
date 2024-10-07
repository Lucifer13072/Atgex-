<?php
// Параметры подключения к базе данных
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

// Получение логина и пароля из запроса
$usr = $_POST['usr'];
$paswd = $_POST['paswd'];

// Формирование SQL запроса
$sql = "SELECT paswd FROM user_list WHERE usr = '$usr'";
$result = $conn->query($sql);

// Проверка результатов запроса
if ($result->num_rows > 0) {
    // Пользователь найден, проверка пароля
    $row = $result->fetch_assoc();
    if (password_verify($paswd, $row['paswd'])) {
        // Пароль верен, возвращаем true
        echo "true";
    } else {
        // Пароль неверен
        echo "false";
    }
} else {
    // Пользователь не найден
    echo "false";
}

// Закрытие соединения с базой данных
$conn->close();
?>