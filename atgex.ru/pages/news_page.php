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
                <div class="col">
                  1 of 3
                </div>
                <div class="col-8">
                    <?php
                    include(__DIR__ . '/../script/php/news.php');
                    ?>
                </div>
                <div class="col">
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