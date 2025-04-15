<?php
session_start();
include "../includes/db.php";

if (isset($_POST['message'])) {
    $user_id = $_SESSION['user_id'];
    $message = $conn->real_escape_string($_POST['message']);
    
    $chat_id_query = "SELECT id FROM chats WHERE user_id='$user_id' AND status='open' LIMIT 1";
    $result = $conn->query($chat_id_query);
    if ($result->num_rows > 0) {
        $chat_id = $result->fetch_assoc()['id'];
    } else {
        $conn->query("INSERT INTO chats (user_id) VALUES ('$user_id')");
        $chat_id = $conn->insert_id;
    }

    $conn->query("INSERT INTO messages (chat_id, sender_type, sender_id, message) 
                  VALUES ('$chat_id', 'user', '$user_id', '$message')");
}
?>
