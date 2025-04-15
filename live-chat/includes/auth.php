<?php
session_start();
include "db.php";

// User Login
function loginUser($email, $password) {
    global $conn;
    $query = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            return true;
        }
    }
    return false;
}

// User Registration
function registerUser($name, $email, $password) {
    global $conn;
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hash')";
    return $conn->query($query);
}
?>
