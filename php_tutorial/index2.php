<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <form class="form-control" id="studentform" enctype="multipart/form-data">
            <input type="hidden" name="action" value="insert">
            <div class="mb-3">
                <input type="text" name="name" id="" class="form-control" placeholder="Name" require>
            </div>
            <div class="mb-3">
                <input type="email" name="email" id="" class="form-control" placeholder="email" require>
            </div>
            <div class="mb-3">
                <input type="text" name="phone" id="" class="form-control" placeholder="Phone" require>
            </div>
            <div class="mb-3">
                <input type="file" name="file" id="" class="form-control" placeholder="File" require>
            </div>
            <button type="submit" class="btn btn-primary">Add Student</button>
        </form>
        <table class="table mt-5">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>File</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="studenttable"></tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function(){
           
            $("#studentform").on("submit", function(e){
                e.preventDefault();
                let formdata = $(this).serialize();
                alert(formdata);
                $.ajax({
                    url:"crud2.php",
                    type:"POST",
                    data:formdata,
                    success:function(response){
                        console.log(response);
                        loadfunction();
                    }
                    
                });
                
            });
            function loadfunction(){
          $.ajax({
            url:"crud2.php",
            type:"POST",
            data:"action=read",
            success:function(response){
                let studentdata = '';
                response.forEach(student => {
                   studentdata += `
                   <tr>
                   <td>${student.id}</td>
                   <td>${student.name}</td>
                   <td>${student.phone}</td>

                   `;
                });
                $("#studenttable").html(studentdata);
                console.log(response);
            }

          })
            }
           

        })
    </script>
</body>
</html>