<?php
/*
 * db.php - Database connection for Theme Park Planner
 * Christopher Boartfield
 * CPSC 5210 - Final Project
 * This file establishes a connection to the MySQL database using PDO and sets error handling attributes.
 */

$host     = 'localhost';
$dbName   = 'theme_park_planner';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database connection failed']);
    exit;
}
?>
