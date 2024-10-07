<?php
session_start();

// Подключение к базе данных
$servername = "localhost";
$username = "atgex-admin";
$password = "YX3jv2r6KBkuKX9";
$dbname = "atgex";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Получение данных из формы
$username = $_POST['username'];
$password = $_POST['password'];

// Защита от SQL инъекций (может потребоваться дополнительная обработка)
$username = mysqli_real_escape_string($conn, $username);
$password = mysqli_real_escape_string($conn, $password);

// Поиск пользователя в базе данных
$sql = "SELECT * FROM user_list WHERE usr='$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Проверка пароля
    if (password_verify($password, $row['paswd'])) {
        // Успешная аутентификация
        session_regenerate_id(); // Обновляем ID сессии для предотвращения атак с подменой сессий
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['userid'] = $row['id']; // Сохраняем ID пользователя в сессии
        header("Location: /../../pages/main.php");
        exit();
    } else {
        echo "Неверный логин или пароль.";
    }
} else {
    echo "Пользователь не найден.";
}

$conn->close();
?>
