<?php
include "../includes/db.php";

if (isset($_POST['chat_id'])) {
    $chat_id = $_POST['chat_id'];
    $query = "UPDATE chats SET status = 'closed' WHERE id = '$chat_id'";
    $conn->query($query);
}
?>
