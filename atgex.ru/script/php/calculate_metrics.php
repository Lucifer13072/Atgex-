<?php
$servername = "localhost";
$username = "atgex-admin";
$password = "YX3jv2r6KBkuKX9";
$dbname = "atgex";

// Создание соединения
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Дата для которой считаем метрики (например, вчерашний день)
$metric_date = date('Y-m-d', strtotime('yesterday'));

// Посещения
$sql_visits = "SELECT COUNT(*) as visits FROM user_activity WHERE activity_type='visit' AND activity_date='$metric_date'";
$result = $conn->query($sql_visits);
$row = $result->fetch_assoc();
$visits = $row['visits'];

// Покупки
$sql_purchases = "SELECT COUNT(*) as purchases FROM user_activity WHERE activity_type='purchase' AND activity_date='$metric_date'";
$result = $conn->query($sql_purchases);
$row = $result->fetch_assoc();
$purchases = $row['purchases'];

// Регистрации
$sql_registrations = "SELECT COUNT(*) as registrations FROM user_activity WHERE activity_type='registration' AND activity_date='$metric_date'";
$result = $conn->query($sql_registrations);
$row = $result->fetch_assoc();
$registrations = $row['registrations'];

// Показатель отказов (bounce rate)
$sql_bounces = "SELECT COUNT(*) as bounces FROM user_activity WHERE activity_type='bounce' AND activity_date='$metric_date'";
$result = $conn->query($sql_bounces);
$row = $result->fetch_assoc();
$bounces = $row['bounces'];

$bounce_rate = ($visits > 0) ? ($bounces / $visits) * 100 : 0.0;

// Конверсия (conversion rate)
$conversions = ($visits > 0) ? ($purchases / $visits) * 100 : 0.0;

// Вставка данных в таблицу site_metrics
$sql_insert = "INSERT INTO site_metrics (metric_date, visits, purchases, registrations, bounce_rate, conversions)
VALUES ('$metric_date', $visits, $purchases, $registrations, $bounce_rate, $conversions)";

if ($conn->query($sql_insert) === TRUE) {
    echo "New metrics record created successfully";
} else {
    echo "Error: " . $sql_insert . "<br>" . $conn->error;
}

$conn->close();
?>
