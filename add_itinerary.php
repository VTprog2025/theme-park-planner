<?php
/*
 * add_itinerary.php - API endpoint to add a ride to the user's itinerary
 * Christopher Boartfield
 * CPSC 5210 - Final Project
 * This file handles POST requests to add a specified ride to the user's itinerary.
 * It validates input, checks for duplicates, and updates the database accordingly.
 */

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

// Is ride already in itinerary for this user?
$stmt = $pdo->prepare('SELECT COUNT(*) FROM itinerary WHERE user_id = :user_id AND ride_id = :ride_id');
$stmt->execute(['user_id' => $user_id, 'ride_id' => $ride_id]);
if ($stmt->fetchColumn() > 0) {
    http_response_code(400);
    echo json_encode(['error' => 'Ride already in itinerary']);
    exit;
}

// Next position is max position + 1 for this user
$stmt = $pdo->prepare('SELECT COALESCE(MAX(position), 0) + 1 FROM itinerary WHERE user_id = :user_id');
$stmt->execute(['user_id' => $user_id]);
$position = $stmt->fetchColumn();

// Insert into itinerary table
$stmt = $pdo->prepare('INSERT INTO itinerary (user_id, ride_id, position) VALUES (:user_id, :ride_id, :position)');
$stmt->execute(['user_id' => $user_id, 'ride_id' => $ride_id, 'position' => $position]);

echo json_encode(['success' => true]);
?>
