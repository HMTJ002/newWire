<?php
include "../utils/database.php";
session_start();

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    echo json_encode(["success" => false, "message" => "User not logged in"]);
    exit;
}

// Read and decode JSON input
$data = json_decode(file_get_contents("php://input"), true);
if (!$data) {
    echo json_encode(["success" => false, "message" => "Invalid JSON"]);
    exit;
}

$user_id = $_SESSION['user'];
$news_id = $data['news_id'] ?? null;
$reaction_type = $data['reaction_type'] ?? null;

// Validate input
if (!$news_id || !$reaction_type) {
    echo json_encode(["success" => false, "message" => "Missing parameters"]);
    exit;
}

// Use prepared statement to prevent SQL injection
$stmt = $conn->prepare("INSERT INTO reactions (user_id, news_id, reaction_type) VALUES (?, ?, ?)");
$stmt->bind_param("sis", $user_id, $news_id, $reaction_type);

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "message" => "Database error"]);
}

$stmt->close();
$conn->close();
?>
