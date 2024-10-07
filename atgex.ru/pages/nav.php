<nav class="navbar navbar-expand-lg" data-bs-theme="dark">
    <a class="navbar-brand" href="/../index.php"><img src="/styles/images/logo.png" style="max-width: 50px; max-height: 50px;"></img>Atgex</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span style='border-color: white' class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="navbar-links" href="/../index.php#about">О нас</a>
            </li>
            <li class="nav-item">
                <a class="navbar-links" href="/pages/news_page.php">Новости</a>
            </li>
            <li class="nav-item">
                <a href="/pages/ADAM.php" class="navbar-links">ADAM</a>
            </li>
            <li class="nav-item dropdown">    
                <div class="dropdown">
                    <a class="navbar-links dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Проекты
                    </a>
                    
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/pages/ADAM.php">ADAM</a></li>
                    </ul>
                </div>
            </li>
        </ul>
    <div class="nav-block">
        <?php
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

            // Проверяем, установлена ли сессия для пользователя
        if(isset($_SESSION['user_id'])) {
            // Пользователь авторизован, выводим кнопку для Личного кабинета
            echo '<div class="btn-group dropstart">';
            echo '<button style="border: none" type="button" class="nav-button btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">';
            echo 'Личный кабинет';
            echo '</button>';
            echo '<ul class="dropdown-menu dropdown-menu-dark">';
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
            $username = "atgex-admin";
            $password = "YX3jv2r6KBkuKX9";
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
            ?>
            <div style="display: flex; justify-content: space-between;">
                <form action="/../script/php/logout.php" method="post"><input class="nav-button" style='border: none; margin: 10px;' type="submit" value="Выйти из аккаунта"></form>
                <form action="/../script/php/logout.php" method="post"><input class="btn-grey" style='border: none; margin: 10px;' type="submit" value="Изменить почту"></form>
                <form action="/../script/php/logout.php" method="post"><input class="btn-grey" style='border: none; margin: 10px;' type="submit" value="Изменить пароль"></form>
            </div>
            <?php
            // Закрытие соединения
            $conn->close();
            echo '</ul>';
            echo '</div>';
        } else {
            // Пользователь не авторизован, выводим кнопки Войти и Регистрация
            echo "<a class='nav-button' data-bs-toggle='modal' data-bs-target='#exampleModal'>Регистрация</a>>";
            echo "<a class='nav-button' data-bs-toggle='modal' data-bs-target='#loginModal'>Войти</a>";
        }
        ?>
        </div>
    </div>
</nav>
<div class="line"></div>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header" style="background-color:  rgb(32, 32, 32);">
            <h1 class="modal-title fs-5" id="exampleModalLabel" style="color: white;">Регистрация</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="background-color:  rgb(32, 32, 32);">
            <form action="/script/php/db.php" method="post">
                <label for="name" style="color: white;">Имя:</label><br>
                <input type="text" id="name" name="name" style="width: 100%; height: 40px;" required><br>
                <label for="password" style="color: white;">Пароль:</label><br>
                <input type="password" id="password" name="password" style="width: 100%; height: 40px;" required><br>
                <label for="email" style="color: white;">Email:</label><br>
                <input type="email" id="email" name="email" style="width: 100%; height: 40px;" required><br>
                <div style='margin-top: 5px' class="line"></div>
                <input type="submit" id="registerButton" class="nav-button" style="border: none" value="Зарегистрироваться">
            </form>
        </div>
        </div>
    </div>
</div>
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header" style="background-color:  rgb(32, 32, 32);">
            <h1 class="modal-title fs-5" id="exampleModalLabel" style="color: white;">Авторизация</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="background-color:  rgb(32, 32, 32);">
            <form action="/script/php/Auth.php" method="post">
                <label for="name" style="color: white;">Логин:</label><br>
                <input type="text" style="width: 100%; height: 40px;" id="nam" name="nam" required><br>
                <label for="password" style="color: white;">Пароль:</label><br>
                <input type="password" style="width: 100%; height: 40px;" id="pasw" name="pasw" required><br>
                <div style='margin-top: 5px' class="line"></div>
                <input class="nav-button" style="border: none" type="submit" value="Войти">
            </form>
        </div>
        </div>
    </div>
</div>