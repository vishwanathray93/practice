<?php
// Database connection
$conn = mysqli_connect('localhost', 'root', '', 'file_tutrial');

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Upload directory setup
$uploadDir = "uploads/";
if (!is_dir($uploadDir)) {
    if (!mkdir($uploadDir, 0755, true)) {
        die("Failed to create upload directory.");
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action']) && $_POST['action'] == 'insert') {
        // echo "hhh";
        $name = isset($_POST['name']) ? $_POST['name'] : '';
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
    } elseif($_POST['action']=='read'){
       $sql = "SELECT * FROM students";
       $result = mysqli_query($conn, $sql);
       $students =[];
       if($result){
        while($row = $result->fetch_assoc()){
            $students[] = $row;

        }
        echo json_encode($students);
       
       }
    }
} 
?>
