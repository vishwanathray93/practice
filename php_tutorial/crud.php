<?php
$conn = mysqli_connect('localhost', 'root', '', 'file_tutrial');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$uploadDir = "uploads/";

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['action'] == "create") {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $fileName = "";

        if (!empty($_FILES[
            "file"]["name"])) {
            $fileName = $_FILES["file"]["name"];
            $filePath = $uploadDir . $fileName;
            move_uploaded_file($_FILES["file"]["tmp_name"], $filePath);
        }

        $sql = "INSERT INTO students (name, email, phone, file) VALUES ('$name', '$email', '$phone', '$fileName')";
        echo $conn->query($sql) ? "Student added successfully!" : "Error: " . $conn->error;
    } 
    
    elseif ($_POST['action'] == "read") {
        $result = $conn->query("SELECT * FROM students ORDER BY id ASC");
        $students = [];
        while ($row = $result->fetch_assoc()) {
            $students[] = $row;
        }
        echo json_encode($students);
    }

    elseif ($_POST['action'] == "update") {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        $updateQuery = "UPDATE students SET name='$name', email='$email', phone='$phone' WHERE id='$id'";
        echo $conn->query($updateQuery) ? "Updated Successfully!" : "Error updating: " . $conn->error;
    } 

    elseif ($_POST['action'] == "delete") {
        $id = $_POST['id'];
        $deleteQuery = "DELETE FROM students WHERE id='$id'";
        echo $conn->query($deleteQuery) ? "Deleted Successfully!" : "Error deleting: " . $conn->error;
    }
    
}

$conn->close();
?>
