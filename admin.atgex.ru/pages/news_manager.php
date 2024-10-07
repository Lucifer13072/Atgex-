<?php
session_start();

// Проверка авторизации
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/../styles/css/styles.css" >
</head>
<body style="background-color: rgb(32, 32, 32);">
    <?php
        include 'nav.php';
    ?>
    
    <div class="container-fluid">
        <div class="row" style="margin-top: 100px">
            <div class="col-2">
                <div class="block-p">
                    <p class="text-m" >Настройка новостей</p>
                    <button type="button" style="margin-top: 10px; margin-left: 30px" class="news_button btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Добавить новость</button>
                    <hr>
                </div>
            </div>
            <div class="col-10">
                <?php
                include '../scripts/php/news.php';
                ?>
            </div>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Добавить новость</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="../scripts/php/add_news.php" method="post" enctype="multipart/form-data">
                    <input class="input-zag" type="text" name="title" placeholder="Заголовок" required><br>
                    <input class="img-btn" type="file" name="image"><br>
                    <textarea class="new" name="text" placeholder="Текст новости" required></textarea><br>
                    <input class="news_button" type="submit" value="Добавить новость">
                </form>
              </div>
            </div>
          </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>