<?php
include "db.php";
session_start();

if (!isset($_POST['receiver_id']) || empty($_POST['receiver_id'])) {
    die("Error: receiver_id is missing");
}

$sender_id = $_SESSION['user_id'];
$receiver_id = $_POST['receiver_id'];
$message = $_POST['message'];
$file = '';

if (!empty($_FILES['file']['name'])) {
    $file = 'uploads/' . basename($_FILES['file']['name']);
    move_uploaded_file($_FILES['file']['tmp_name'], $file);
}

// Insert message only if receiver exists
$stmt = $conn->prepare("INSERT INTO messages (sender_id, receiver_id, message, file) VALUES (?, ?, ?, ?)");
$stmt->bind_param("iiss", $sender_id, $receiver_id, $message, $file);
$stmt->execute();
$stmt->close();

echo "Message Sent!";
?>
