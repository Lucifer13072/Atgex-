<?php
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

// Получение IP-адреса пользователя
$ip_address = $_SERVER['REMOTE_ADDR'];
$current_date = date('Y-m-d');

// Проверка количества запросов с этого IP-адреса за текущий день
$check_ip_sql = $conn->prepare("SELECT request_count FROM ip_requests WHERE ip_address = ? AND request_date = ?");
$check_ip_sql->bind_param("ss", $ip_address, $current_date);
$check_ip_sql->execute();
$check_ip_result = $check_ip_sql->get_result();

if ($check_ip_result->num_rows > 0) {
    $row = $check_ip_result->fetch_assoc();
    if ($row['request_count'] >= 3) {
        exit("Превышено количество запросов за день. Попробуйте снова завтра.");
    } else {
        // Обновление количества запросов
        $update_ip_sql = $conn->prepare("UPDATE ip_requests SET request_count = request_count + 1 WHERE ip_address = ? AND request_date = ?");
        $update_ip_sql->bind_param("ss", $ip_address, $current_date);
        $update_ip_sql->execute();
    }
} else {
    // Вставка нового IP-адреса в таблицу
    $insert_ip_sql = $conn->prepare("INSERT INTO ip_requests (ip_address, request_date, request_count) VALUES (?, ?, 1)");
    $insert_ip_sql->bind_param("ss", $ip_address, $current_date);
    $insert_ip_sql->execute();
}

// Защита от SQL-инъекций (используется функция mysqli_real_escape_string)
$usr = $conn->real_escape_string($_POST['name']);
$paswd = password_hash($_POST['password'], PASSWORD_DEFAULT);
$email = $conn->real_escape_string($_POST['email']);

// Проверка существования логина в базе данных
$check_sql = $conn->prepare("SELECT COUNT(*) AS count FROM user_list WHERE usr = ?");
$check_sql->bind_param("s", $usr);
$check_sql->execute();
$check_result = $check_sql->get_result();
if ($check_result) {
    $row = $check_result->fetch_assoc();
    if ($row['count'] > 0) {
        exit(); // Завершаем скрипт, чтобы предотвратить создание дублирующей записи
    }
} else {
    exit();
}

// Генерация случайного ключа
$uuid = "adam-" . substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(30/strlen($x)) )),1,30);

// Подготовка и выполнение запроса на вставку нового пользователя
$sql = $conn->prepare("INSERT INTO user_list (usr, paswd, email, have_key, uuid, rules) VALUES (?, ?, ?, 0, ?, 4)");
$sql->bind_param("ssss", $usr, $paswd, $email, $uuid);

if ($sql->execute() === TRUE) {
    // Автоматическая авторизация пользователя после успешной регистрации
    session_start();
    $_SESSION['user_id'] = $conn->insert_id; // ID нового пользователя
    header("Location: https://atgex.ru/index.php"); // Перенаправляем на главную страницу
    exit();
} else {
    echo "Error: " . $sql->error;
}

// Закрытие соединения с базой данных
$conn->close();
?>
