<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit();
}
include "../includes/db.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/style.css">
    <script src="../assets/admin.js" defer></script>
</head>
<body>
    <h2>Admin Panel</h2>
    <div id="chats-container"></div>
</body>
</html>
