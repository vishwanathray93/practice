<?php
session_start();
include "../includes/db.php";

$user_id = $_SESSION['user_id'];
$chat_id_query = "SELECT id FROM chats WHERE user_id='$user_id' AND status='open' LIMIT 1";
$result = $conn->query($chat_id_query);

if ($result->num_rows > 0) {
    $chat_id = $result->fetch_assoc()['id'];
    $query = "SELECT * FROM messages WHERE chat_id='$chat_id' ORDER BY created_at ASC";
    $messages = $conn->query($query);

    while ($msg = $messages->fetch_assoc()) {
        $class = ($msg['sender_type'] == 'user') ? "user" : "admin";
        echo "<div class='message $class'>{$msg['message']}</div>";
    }
    
}
?>
