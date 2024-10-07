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
            <div class="about" style="margin-bottom: 200px;">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <p class="big-text" style="margin-top: 10px;">ADAM</p>
                            <p class="description">Автономный голосовой помощник в вашем компьютере</p>
                            <p class="description">Приложение представляет собой интерфейс с голосовым ассистентом основанном на языковой модели и 3д аватаром.</p>
                            <p class="description">Всего помощника 2: Адам и Ева</p>
                            <p style="margin-top: 100px;" class="description">Выбор голоса: </p>
                            <a style="margin-right: 5px;" class="button">Адам</a><a class="button">Ева</a>
                        </div>
                        <div class="col">
                        <div id="canvas-container"></div>
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
                            <script type="module" src="/script/js/neon.js"></script>
                        </div>
                        <div class="col">
                            <p class="description" style="margin-top: 300px;">Адам: тактичный и спокойный. Много знает о военных технологиях, политике, играх.</p>
                            <p class="description">Ева: веселая милая девушка. Может много рассказать об информациооных технологиях и истории и литературе.</p>
                        </div>
                    </div>
                </div>
                <div class="line" style="border-top: 2px solid #3a3a3a;"></div>
                <div style="margin-top: 100px;" class="container text-center">
                    <div class="row">
                        <div class="col">
                            <p class="description">Eva concept</p>
                            <div><img class="image-ab" src="/../styles/images/Eva.jpg"></div>
                        </div>
                        <div class="col">
                            <p style="margin-bottom: 50px;" class="description">interface</p>
                            <img class="image-mid" src="/../styles/images/interface.PNG">
                        </div>
                        <div class="col">
                            <p class="description">ADAM concept</p>
                            <div><img class="image-ab" src="/../styles/images/ADAM.jpg"></div>
                        </div>
                    </div>
                </div>
                <div class="line" style="border-top: 2px solid #3a3a3a;"></div>
                <div class="download">
                    <p class="description">Последняя версия релиза: alf 0.0.1</p>
                    <a style="margin-right: 5px;" class="button" data-bs-toggle="modal" data-bs-target="#downloadModal">Скачать</a>
                    <p style="margin-top: 40px;" class="description">Что дает премиум: </p>
                    <li class="description">Возможность кастомизации аватара</li>
                    <li class="description">Голосовое управление устройством</li>
                    <li class="description">Обработка изображений</li>
                </div>
            </div>

            <div class="modal fade" id="downloadModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content" style="background-color: #3a3a3a;">
                        <div class="modal-header">
                            <p class="description" style="color: white;">Выберете систему:</p>
                        </div>
                        <div class="modal-body"> 
                            <a href="" class="button">Windows</a><a style="margin-left: 5px;" href="" class="button">Mac</a><a style="margin-left: 5px;" href="" class="button">Linux</a>
                        </div>
                    </div>
                </div>
            </div>



            <?php
            include 'footer.php';
            ?> 
        </div>
    </div>
    <script src="/../script/js/analitics.js"></script>
    <script src="/../script/js/backgroung_neon.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>