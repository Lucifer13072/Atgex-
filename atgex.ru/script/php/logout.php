<?php
session_start(); // Начинаем сессию

// Удаляем сессию
session_unset();
session_destroy();

// Удаляем куки, если они были установлены
if(isset($_COOKIE['user_id'])) {
    setcookie('user_id', '', time() - 3600, '/'); // Устанавливаем время в прошлое, чтобы куки были удалены
}

// Перенаправляем пользователя на главную страницу или другую страницу, где будет форма для входа
header("Location: /../../index.php"); // Замените index.php на адрес вашей главной страницы
exit();
?>
