<?php
// Подключение к базе данных
$servername = "localhost";
$username = "atgex-admin";
$password = "YX3jv2r6KBkuKX9";
$dbname = "atgex"; // Имя вашей базы данных

$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
  die("Ошибка подключения: " . $conn->connect_error);
}

// Запрос к базе данных
$sql = "SELECT * FROM user_list";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // Вывод данных каждого пользователя в отдельный div
  while($row = $result->fetch_assoc()) {
    echo '<div class="user-item">';
    echo '<p class="user-text">Пользователь: ' . $row["usr"]. '</p>';
    echo '<p class="user-text">Email: ' . $row["email"]. '</p>';
    echo '<p class="user-text">Статус: ' . getRulesText($row["rules"]) . '</p>';
    echo '</div>';
  }
} else {
  echo "0 результатов";
}
$conn->close();

// Функция для получения текста статуса на основе значения rules
function getRulesText($rules) {
  switch ($rules) {
    case 1:
      return "Администратор";
    case 2:
      return "Модератор";
    case 3:
      return "Подписка";
    case 4:
      return "Пользователь";
    default:
      return "Неизвестно";
  }
}
?>
