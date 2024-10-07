<?php
session_start();

// Уничтожаем все данные сессии
session_destroy();

// Перенаправляем пользователя на страницу входа или на другую страницу
header("Location: /../../index.php");
exit();
?>
