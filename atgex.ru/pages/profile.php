<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(isset($_SESSION['user_id'])) {
?>
<!DOCTYPE html>
<html lang="en"> 
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADAM project</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/../styles/css/main.css" >
</head>
<body style="background-color: rgb(32, 32, 32);">
    <canvas id="canvas-line"></canvas>
    <div class="main">
        <div class="container-fluid">
            <?php
            include 'nav.php';
            ?> 
            <div class="row">
                <div class="col-4">
                    <div class="block">
                        <div class="inform" style="margin: 10px">
                            <?php
                            if (session_status() == PHP_SESSION_NONE) {
                                session_start(); // Начинаем сессию, если она еще не начата
                            }
                            
                            // Функция для перевода числовых значений ролей в текстовые описания
                            function translateRole($role) {
                                switch ($role) {
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
                            
                            // Подключение к базе данных
                            $servername = "localhost";
                            $username = "root";
                            $password = "Tytyber13112007";
                            $dbname = "atgex";
                            
                            // Создание подключения
                            $conn = new mysqli($servername, $username, $password, $dbname);
                            
                            // Проверка соединения
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }
                            
                            if(isset($_SESSION['user_id'])) {
                                // Получаем ID текущего пользователя из сессии
                                $user_id = $_SESSION['user_id'];
                                
                                // Запрос на получение информации о пользователе
                                $sql = "SELECT usr, email, rules FROM user_list WHERE id = '$user_id'";
                                $result = $conn->query($sql);
                            
                                if ($result->num_rows > 0) {
                                    // Вывод данных каждой строки
                                    while($row = $result->fetch_assoc()) {
                                        echo "<p style='margin-left: 10px' class='description'>Логин: " . $row["usr"]. "</p>";
                                        echo "<p style='margin-left: 10px' class='description'>Почта: " . $row["email"]. "</p>";
                                        // Передача числового значения роли в функцию translateRole()
                                        echo "<p style='margin-left: 10px' class='description'>Роль: " . translateRole($row["rules"]) . "</p>";
                                    }
                                } else {
                                    echo "0 результатов";
                                }
                            } else {
                                echo "Пользователь не авторизован.";
                            }
                            
                            // Закрытие соединения
                            $conn->close();
                            ?>
                        </div>
                        <div style="display: flex; justify-content: space-between;">
                            <form action="/../script/php/logout.php" method="post"><input class="nav-button" style='border: none; margin: 10px;' type="submit" value="Выйти из аккаунта"></form>
                            <form action="/../script/php/logout.php" method="post"><input class="btn-grey" style='border: none; margin: 10px;' type="submit" value="Изменить почту"></form>
                            <form action="/../script/php/logout.php" method="post"><input class="btn-grey" style='border: none; margin: 10px;' type="submit" value="Изменить пароль"></form>
                        </div>
                    </div>
                </div>
                <div class="col-8">
                    <div class="block">
                        <div class="Pod-block" style="margin: 10px">
                            <p style="font-size: 20px" class='description'>1234567890</p>
                        </div>
                    </div>
                </div>
             </div>
            <?php
            include 'footer.php';
            ?> 
        </div>
    </div>
    <script src="/../script/js/backgroung_neon.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
<?php
} else {
    // Пользователь не авторизован, перенаправляем его на страницу авторизации
    header("Location: /../index.php"); // Замените login.php на адрес вашей страницы авторизации
    exit();
}        
?>