<?php
// remove_itinerary.php - API endpoint to remove a ride from user's itinerary
// Christopher Boartfield
// CPSC 5210 - Final Project
// This file handles POST requests to remove a specified ride from the user's itinerary.
// It validates input and updates the database accordingly.

header('Content-Type: application/json');
require_once 'db.php';

// Read JSON input from request body
$data = json_decode(file_get_contents('php://input'), true);

// Extract user and ride ID from request data
$user_id = $data['user_id'] ?? null;
$ride_id = $data['ride_id'] ?? null;

// Validation for user_id and ride_id
if (!$user_id || !$ride_id) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing user_id or ride_id']);
    exit;
}

// Delete from itinerary where user_id and ride_id match
$stmt = $pdo->prepare('DELETE FROM itinerary WHERE user_id = :user_id AND ride_id = :ride_id');
$stmt->execute(['user_id' => $user_id, 'ride_id' => $ride_id]);

echo json_encode(['success' => true]);
?>
