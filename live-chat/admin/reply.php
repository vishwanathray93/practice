<?php
session_start();
include "../includes/db.php";

if (isset($_POST['chat_id'], $_POST['message'])) {
    $chat_id = $_POST['chat_id'];
    $admin_id = $_SESSION['admin_id'];
    $message = $conn->real_escape_string($_POST['message']);

    $query = "INSERT INTO messages (chat_id, sender_type, sender_id, message) 
              VALUES ('$chat_id', 'admin', '$admin_id', '$message')";
    $conn->query($query);
}
?>
