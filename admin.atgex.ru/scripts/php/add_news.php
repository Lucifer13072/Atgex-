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

// Получение данных из формы
$title = $_POST['title'];
$text = $_POST['text'];
$image = $_FILES['image']['name']; // Имя загруженного файла изображения

// Проверка, было ли загружено изображение
if (!empty($image)) {
    // Загрузка изображения на сервер
    $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/uploads/"; // Полный путь к директории для загрузки изображений
    $target_file = $target_dir . basename($image);

    // Перемещение изображения из временного хранилища в указанную директорию
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        echo "Файл " . htmlspecialchars(basename($image)) . " был успешно загружен.";
    } else {
        echo "Произошла ошибка при загрузке файла.";
    }
}

// Добавление новости в базу данных с использованием подготовленных выражений
$stmt = $conn->prepare("INSERT INTO news (title, image, text) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $title, $image, $text);

if ($stmt->execute() !== TRUE) {
    echo "Ошибка: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
