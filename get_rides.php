<?php
// get_rides.php - API endpoint to fetch rides with optional filters
// Christopher Boartfield
// CPSC 5210 - Final Project
// This file handles GET requests to retrieve a list of rides from the database,
// applying optional filters for park, thrill level, and maximum wait time.
// It constructs a dynamic SQL query based on the provided filters and returns the results as JSON.

header('Content-Type: application/json');
require_once 'db.php';

$park     = $_GET['park']     ?? null;
$thrill   = $_GET['thrill']   ?? null;
$max_wait = $_GET['max_wait'] ?? null;

$sql = "SELECT * FROM rides WHERE 1=1";
if ($park)     $sql .= " AND park = :park";
if ($thrill)   $sql .= " AND thrill_level = :thrill";
if ($max_wait) $sql .= " AND wait_time <= :max_wait";

$stmt = $pdo->prepare($sql);
if ($park)     $stmt->bindValue(':park', $park);
if ($thrill)   $stmt->bindValue(':thrill', $thrill);
if ($max_wait) $stmt->bindValue(':max_wait', $max_wait, PDO::PARAM_INT);

$stmt->execute();
$rides = $stmt->fetchAll();

echo json_encode($rides);
?>
