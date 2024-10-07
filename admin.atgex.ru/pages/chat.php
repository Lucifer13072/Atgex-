<?php
session_start();

// Проверка авторизации
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: /../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Рабочий чат</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/styles/css/styles.css">
</head>
<body style="background-color: rgb(32, 32, 32);">
    <?php include 'nav.php'; ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-4">
                <h3>Ваши чаты</h3>
                <ul id="chat-list">
                    <!-- Здесь будут отображаться чаты пользователя -->
                </ul>
                <button type="button" onclick="openCreateChatModal()">Создать новый чат</button>
            </div>
            <div class="col-8">
                <div id="chat">
                    <div id="chat-messages">
                        <!-- Здесь будут отображаться сообщения чата -->
                    </div>
                    <form id="message-form">
                        <input type="text" id="message-input" placeholder="Введите сообщение...">
                        <button type="submit">Отправить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="/../scripts/js/chat.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
