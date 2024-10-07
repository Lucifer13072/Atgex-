<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Начинаем сессию, если она еще не начата
} // Начинаем сессию

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

// Защита от SQL-инъекций (используется функция mysqli_real_escape_string)
$usr = mysqli_real_escape_string($conn, $_POST['nam']);
$password = $_POST['pasw']; // Не защищаем пароль от SQL-инъекций, так как будем использовать его для сравнения с хэшем из базы данных

// Подготовка SQL-запроса для получения данных пользователя
$sql = "SELECT * FROM user_list WHERE usr = '$usr'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Пользователь с таким логином найден
    $row = $result->fetch_assoc();
    // Проверяем введенный пароль с хэшем из базы данных
    if (password_verify($password, $row['paswd'])) {
        // Пароль совпадает, пользователь авторизован
        $_SESSION['user_id'] = $row['id']; // Сохраняем ID пользователя в сессии
        // Здесь можете добавить другие данные пользователя в сессию, если нужно
        // Например: $_SESSION['username'] = $row['usr'];
        
        // Также устанавливаем куки, чтобы запомнить пользователя
        $cookie_name = "user_id";
        $cookie_value = $row['id'];
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // куки на 30 дней
        // Замените 86400 на нужное количество секунд для длительности куки
        
        // Перенаправляем пользователя на страницу Личного кабинета
        header("Location: atgex.ru/../../../index.php");
        exit();
    } else {
        // Неправильный пароль
        echo "Неверный логин или пароль.";
    }
} else {
    // Пользователь с таким логином не найден
    echo "Неверный логин или пароль.";
}

// Закрытие соединения с базой данных
$conn->close();
?>