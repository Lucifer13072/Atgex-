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
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="/../styles/css/styles.css" >
</head>
<body style="background-color: rgb(32, 32, 32);">
    <?php
        include "nav.php";
    ?>
    
    <div class="container">
        <div class="row">
            <div class="row">
                <div class="col">
                    <div class="chart-container">
                        <canvas id="visitsChart"></canvas>
                    </div>
                </div>
                <div class="col">
                    <div class="chart-container">
                        <canvas id="purchasesChart"></canvas>
                    </div>
                </div>
                <div class="col">
                    <div class="chart-container">
                        <canvas id="registrationsChart"></canvas>
                    </div>
                </div>
            </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        fetch('/../scripts/php/get_metrics.php')
            .then(response => response.json())
            .then(data => {
                const labels = data.map(row => row.metric_date);
                const visits = data.map(row => row.visits);
                const purchases = data.map(row => row.purchases);
                const registrations = data.map(row => row.registrations);

                const ctxVisits = document.getElementById('visitsChart').getContext('2d');
                const visitsChart = new Chart(ctxVisits, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Посещения',
                            data: visits,
                            color: 'rgba(5, 221, 250, 1)',
                            borderColor: 'rgba(5, 221, 250, 1)',
                            backgroundColor: 'rgba(9, 202, 227, 1)',
                        }]
                    }
                });

                const ctxPurchases = document.getElementById('purchasesChart').getContext('2d');
                const purchasesChart = new Chart(ctxPurchases, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Покупки',
                            data: purchases,
                            borderColor: 'rgba(33, 214, 30, 1)',
                            backgroundColor: 'rgba(59, 232, 56, 1)',
                        }]
                    }
                });

                const ctxRegistrations = document.getElementById('registrationsChart').getContext('2d');
                const registrationsChart = new Chart(ctxRegistrations, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Регистрации',
                            data: registrations,
                            borderColor: 'rgba(235, 197, 9, 1)',
                            backgroundColor: 'rgba(181, 161, 62, 1)',
                            color: 'rgba(181, 161, 62, 1)', // Цвет надписей на графике
                        }]
                    }
                });
            });
    </script>
    
    <div class="row">
        <div class="col">
            <div class="block-p">
                
            </div>
        </div>
        <div class="col">
          2 of 3
        </div>
        <div class="col">
          3 of 3
        </div>
     </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>