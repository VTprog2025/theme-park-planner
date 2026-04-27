<?php
// get_itinerary.php - API endpoint to fetch a user's itinerary
// Christopher Boartfield
// CPSC 5210 - Final Project
// This file handles GET requests to retrieve all rides in the user's itinerary,
// joined with the rides table to return full ride details ordered by position.

header('Content-Type: application/json');
require_once 'db.php';

$user_id = $_GET['user_id'] ?? null;

if (!$user_id) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing user_id']);
    exit;
}

$stmt = $pdo->prepare('
    SELECT r.*
    FROM rides r
    JOIN itinerary i ON r.id = i.ride_id
    WHERE i.user_id = :user_id
    ORDER BY i.position
');
$stmt->execute(['user_id' => $user_id]);
$rides = $stmt->fetchAll();

echo json_encode($rides);
?>
