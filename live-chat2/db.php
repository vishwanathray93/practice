<?php
$conn = new mysqli("localhost", "root", "", "live_chat2");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
