<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD with AJAX</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">

        <!-- Add Student Form -->
        <form id="studentForm" enctype="multipart/form-data">
            <input type="hidden" name="action" value="create">
            <div class="mb-3">
                <input type="text" name="name" class="form-control" placeholder="Name" required>
            </div>
            <div class="mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="mb-3">
                <input type="text" name="phone" class="form-control" placeholder="Phone" required>
            </div>
            <div class="mb-3">
                <input type="file" name="file" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Add Student</button>
        </form>

        <!-- Student Table -->
        <table class="table mt-4">
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
            <tbody id="studentTable"></tbody>
        </table>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        <input type="hidden" name="id" id="editId">
                        <div class="mb-3">
                            <input type="text" name="name" id="editName" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <input type="email" name="email" id="editEmail" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" name="phone" id="editPhone" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-success">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            loadStudents();

            // Create Student
            $("#studentForm").on("submit", function(e) {
                e.preventDefault();
                $.ajax({
                    url: "crud.php",
                    type: "POST",
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        alert(response);
                        $("#studentForm")[0].reset();
                        loadStudents();
                    }
                });
            });

            // Load Students
            function loadStudents() {
                $.ajax({
                    url: "crud.php",
                    type: "POST",
                    data: { action: "read" },
                    success: function(response) {
                        let students = JSON.parse(response);
                        let tableData = "";
                        students.forEach(student => {
                            tableData += `<tr>
                                <td>${student.id}</td>
                                <td>${student.name}</td>
                                <td>${student.email}</td>
                                <td>${student.phone}</td>
                                <td><img src="uploads/${student.file}" width="50"></td>
                                <td>
                                    <button class="btn btn-warning btn-sm edit" data-id="${student.id}" data-name="${student.name}" data-email="${student.email}" data-phone="${student.phone}">Edit</button>
                                    <button class="btn btn-danger btn-sm delete" data-id="${student.id}">Delete</button>
                                </td>
                            </tr>`;
                        });
                        $("#studentTable").html(tableData);
                    }
                });
            }

            // Open Edit Modal
            $(document).on("click", ".edit", function() {
                $("#editId").val($(this).data("id"));
                $("#editName").val($(this).data("name"));
                $("#editEmail").val($(this).data("email"));
                $("#editPhone").val($(this).data("phone"));
                $("#editModal").modal("show");
            });

            // Update Student
            $("#editForm").on("submit", function(e) {
                e.preventDefault();
                $.ajax({
                    url: "crud.php",
                    type: "POST",
                    data: $(this).serialize() + "&action=update",
                    success: function(response) {
                        alert(response);
                        $("#editModal").modal("hide");
                        loadStudents();
                    }
                });
            });

            // Delete Student
            $(document).on("click", ".delete", function() {
                if (confirm("Are you sure to delete?")) {
                    let id = $(this).data("id");
                    $.post("crud.php", { action: "delete", id: id }, function(response) {
                        alert(response);
                        loadStudents();
                    });
                }
            });
        });
    </script>
</body>
</html>
