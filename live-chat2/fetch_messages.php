<?php
include "db.php";
session_start();
header('Content-Type: application/json'); // Ensure JSON response

if (!isset($_POST['receiver_id'])) {
    echo json_encode(["error" => "receiver_id is missing"]);
    exit;
}

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["error" => "Unauthorized"]);
    exit;
}

$admin_id = $_SESSION['user_id'];
$receiver_id = $_POST['receiver_id'];

// Fetch only messages exchanged between admin and selected user
$stmt = $conn->prepare("
    SELECT id, sender_id, receiver_id, message, file, timestamp 
    FROM messages 
    WHERE (sender_id = ? AND receiver_id = ?) 
       OR (sender_id = ? AND receiver_id = ?) 
    ORDER BY timestamp ASC
");
$stmt->bind_param("iiii", $admin_id, $receiver_id, $receiver_id, $admin_id);
$stmt->execute();
$result = $stmt->get_result();
$messages = $result->fetch_all(MYSQLI_ASSOC);

echo json_encode($messages, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); // Ensure correct JSON output
?>
