<?php
include "../includes/db.php";

$query = "SELECT chats.id, users.name FROM chats 
          JOIN users ON chats.user_id = users.id 
          WHERE chats.status = 'open'";
$result = $conn->query($query);

while ($chat = $result->fetch_assoc()) {
    echo "<div onclick='openChat({$chat['id']})'>{$chat['name']}</div>";
}
?>
