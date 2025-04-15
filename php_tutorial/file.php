<?php 
$conn = mysqli_connect('localhost', 'root', '', 'file_tutrial');
if(!$conn){
    echo "Error to connect DB";
}
    // if(isset($_FILES['files'])){
    //     $file = $_FILES['files'];
    //     echo "<pre>";
    //     print_r($file);
    //     echo "</pre>";
    // }
    if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_FILES['files'])){
       $name = $_POST['name'];
       $email = $_POST['email'];
       $phone = $_POST['phone'];
       $files = $_FILES['files']['name'];
    //    echo $name .''.$email.'  '.$phone.' '.$files.' ';
       $uploadDir = 'uploads/';
       if(!is_dir($uploadDir)){
        mkdir($uploadDir, 0777, true);

       }
       $filename = basename($_FILES['files']['name']);
       $filepath = $uploadDir.$filename;
       move_uploaded_file($_FILES['files']['tmp_name'], $filepath);
    //    echo "<img src='$file'>";
    
       $sql = "INSERT INTO `students` (`name`, `email`, `phone`, `file`) VALUES('$name', '$email', '$phone', '$files')";
    $result = mysqli_query($conn, $sql);
    
    if($result){
        echo "Inserted Successfully";
    } else{
        echo "Error to insert";
    }
    } else {
        echo "All Fields are Required";
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">File Upload Form</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" name="phone" id="phone" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="fileid" class="form-label">Upload File</label>
                <input type="file" name="files" id="fileid" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>
