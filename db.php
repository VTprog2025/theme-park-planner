<?php
// TODO: Set your database credentials
$host     = 'localhost';
$dbName   = 'theme_park_planner';
$username = 'root';
$password = '';

try {
    // TODO: Create PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // TODO: Handle connection error
    http_response_code(500);
    echo json_encode(['error' => 'Database connection failed']);
    exit;
}
?>
