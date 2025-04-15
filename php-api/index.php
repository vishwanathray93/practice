<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD with AJAX</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="container mt-4">
    <h2 class="text-center">CRUD with PHP API, AJAX, and Bootstrap</h2>

    <!-- Search Input -->
   

    <!-- Add User Form -->
    <div class="card p-3">
        <form id="userForm">
            <input type="hidden" id="userId">
            <div class="mb-3">
                <label>Name</label>
                <input type="text" id="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" id="email" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>

    <div class="mb-3">
    <div class="searchFilter_wrapper d-flex align-items-center gap-3 p-3 bg-light rounded shadow-sm">
    <!-- Search Input -->
            <input type="text" id="searchInput" class="form-control form-control-sm w-50" placeholder="Search users by name or email...">

            <!-- Items per page dropdown -->
            <div class="d-flex align-items-center gap-2">
                <label for="itemsPerPage" class="me-1 fw-bold">Items per page:</label>
                <select id="itemsPerPage" class="form-select form-select-sm">
                    <option value="10" selected>10</option>
                    <option value="20">20</option>
                    <option value="30">30</option>
                </select>
            </div>
        </div>

   
    <!-- User Table -->
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="userTable"></tbody>
    </table>
   <div id="pagination" class="mt-3"></div>
 </div> 
</div>
<!-- Edit Modal -->
<div class="modal fade" id="editModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    <input type="hidden" id="editId">
                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" id="editName" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" id="editEmail" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
