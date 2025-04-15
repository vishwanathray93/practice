<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "pagination");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Pagination Variables
$limit = 15;
// $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = isset($_GET['page']) ? $_GET['pag']: 1;
$offset = ($page - 1) * $limit; //offset is how many items have to skips when click on page or after how many items will
// be shown 

// Total Records
$result = $conn->query("SELECT COUNT(*) AS total FROM users");
$row = $result->fetch_assoc();
$total_records = $row['total'];
$total_pages = ceil($total_records / $limit);

// Fetch Data
$sql = "SELECT * FROM users LIMIT $limit OFFSET $offset";
$data = $conn->query($sql);

// Display Table
echo "<table border='1'>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
        </tr>";
while ($row = $data->fetch_assoc()) {
    echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['name']}</td>
            <td>{$row['email']}</td>
          </tr>";
}
echo "</table>";

// Pagination Buttons
echo "<div style='margin-top: 20px;'>";
if ($page > 1) {
    echo "<a href='?page=" . ($page - 1) . "'>« Previous</a> ";
}
for ($i = 1; $i <= $total_pages; $i++) {
    $active = ($i == $page) ? "style='font-weight:bold;'" : "";
    echo "<a href='?page=$i' $active> $i </a> ";
}
if ($page < $total_pages) {
    echo "<a href='?page=" . ($page + 1) . "'>Next »</a>";
}
echo "</div>";

?>

</body>
</html>