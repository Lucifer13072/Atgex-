<?php
session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Админ панель Atgex</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/css/styles.css" >
</head>
<body class="body" style="background-color: rgb(32, 32, 32);">
    <canvas id="canvas-line"></canvas>
    <div class="main">
        <div class="container-fluid" styles="max-width: 80%;">
            <div class="block">
                <h2 class="hight-text">Admin Panel</h2>
                <div class="login-form">
                    <div class="form-l">
                        <form action="scripts/php/login.php" method="post">
                            <label class="form-text" style="margin-top: 100px;" for="username">Login:</label><br>
                            <input class="form-input" type="text" id="username" name="username"><br>
                            <label class="form-text" for="password">Password:</label><br>
                            <input class="form-input" type="password" id="password" name="password"><br><br>
                            <input class="form-button" type="submit" value="Login">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/scripts/js/background.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>