<!DOCTYPE html>
<html lang="en"> 
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    include "pages/meta_tags.php";
    ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/css/main.css" >
</head>
<body style="background-color: rgb(32, 32, 32);">
    <canvas id="canvas-line"></canvas>
    <div class="main">
        <div class="container-fluid"> 
            <?php
            include 'pages/nav.php';
            ?>    
            <div class="head">
                <div class="container" style="margin-top: 200px; margin-bottom: 200px;">
                    <div class="coll" style='justify-content: start;'>
                        <div class="text-container">
                            <p class="big-text">Atgex</p>
                            <p class="medium-text">Молодой стартап в области ИИ</p>
                        </div>
                    </div>
                    <div class="coll">
                        <div id="canvas-container"></div>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
                        <script type="module" src="/script/js/neon.js"></script>
                    </div>  
                </div>
                <div class="line" style="border-top: 2px solid #3a3a3a;"></div>
                <div class="about" id="about">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col">
                                <p class="main-tag">Специализация</p>
                                <p class="description">Наша специализация разработка и исследования нейросетей для обработки естественного языка и изображений</p>
                            <div class="col">
                                <p class="main-tag">Цели и планы</p>
                                <p class="description">Grgegegegergergergegergergergr</p>
                            </div>
                        </div>
                        <div class="line" style="border-top: 2px solid #3a3a3a;"></div>
                    </div>
                </div>
                <div class="about">

                </div>
            </div>
            <?php
            include 'pages/footer.php';
            ?> 
        </div>
    </div>
    <script src="/script/js/analitics.js"></script>
    <script src="/script/js/backgroung_neon.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>