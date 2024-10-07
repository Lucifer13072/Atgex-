<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Если пользователь не авторизован, перенаправляем на страницу логина
    exit();
}

// Параметры подключения к базе данных
$servername = "localhost";
$username = "atgex-admin";
$password = "YX3jv2r6KBkuKX9";
$dbname = "atgex";

// Создание подключения к базе данных
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Получаем ID текущего пользователя
$user_id = $_SESSION['user_id'];

// Получаем и защищаем данные из формы
$old_password = $_POST['old_password'];
$new_password = $_POST['new_password'];

// Получение текущего пароля пользователя из базы данных
$sql = "SELECT paswd FROM user_list WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $hashed_old_password = $row['paswd'];
    
    // Проверка правильности старого пароля
    if (password_verify($old_password, $hashed_old_password)) {
        // Хеширование нового пароля
        $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);
        
        // Обновление пароля в базе данных
        $update_sql = "UPDATE user_list SET paswd = ? WHERE id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("si", $hashed_new_password, $user_id);
        
        if ($update_stmt->execute()) {
            echo "Пароль успешно изменен.";
            header("Location: https://atgex.ru/index.php"); // Перенаправляем на главную страницу
            exit();
        } else {
            echo "Ошибка при изменении пароля: " . $conn->error;
        }
    } else {
        echo "Неверный старый пароль.";
    }
} else {
    echo "Пользователь не найден.";
}

// Закрытие соединения с базой данных
$conn->close();
?>
