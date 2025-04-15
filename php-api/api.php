<?php
include 'db.php';

header("Content-Type: application/json");

$action = $_GET['action'] ?? '';

if ($action == "fetch") {
    $search = $_GET['search'] ?? '';
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
    $offset = ($page - 1) * $limit;

    // Fix: Ensure order by ID (or name/email)
    $query = "SELECT * FROM users WHERE name LIKE '%$search%' OR email LIKE '%$search%' ORDER BY id DESC LIMIT $limit OFFSET $offset";
    $result = $conn->query($query);

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    // Fix: Get total count correctly
    $countQuery = "SELECT COUNT(*) as total FROM users WHERE name LIKE '%$search%' OR email LIKE '%$search%'";
    $countResult = $conn->query($countQuery);
    $totalRows = $countResult->fetch_assoc()['total'];
    $totalPages = ceil($totalRows / $limit);

    echo json_encode([
        'data' => $data,
        'total_pages' => $totalPages
    ]);
}

// Insert User
if ($action == "insert") {
    $name = $_POST['name'];
    $email = $_POST['email'];

    $stmt = $conn->prepare("INSERT INTO users (name, email) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $email);
    $stmt->execute();

    echo json_encode(["success" => true]);
}

// Get Single User
if ($action == "getUser") {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM users WHERE id = $id");
    echo json_encode($result->fetch_assoc());
}

// Update User
if ($action == "update") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    $stmt = $conn->prepare("UPDATE users SET name=?, email=? WHERE id=?");
    $stmt->bind_param("ssi", $name, $email, $id);
    $stmt->execute();

    echo json_encode(["success" => true]);
}

// Delete User
if ($action == "delete") {
    $id = $_POST['id'];
    $conn->query("DELETE FROM users WHERE id = $id");
    echo json_encode(["success" => true]);
}
?>
