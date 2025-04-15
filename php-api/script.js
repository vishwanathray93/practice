$(document).ready(function () {
    fetchUsers();

    function fetchUsers(search = '', page = 1, limit = 10) {
        $.ajax({
            url: `api.php?action=fetch&search=${search}&page=${page}&limit=${limit}`,
            type: 'GET',
            success: function (response) {
                let rows = '';
                $.each(response.data, function (index, user) {
                    rows += `<tr>
                        <td>${user.id}</td>
                        <td>${user.name}</td>
                        <td>${user.email}</td>
                        <td>
                            <button class="btn btn-warning btn-sm editBtn" data-id="${user.id}">Edit</button>
                            <button class="btn btn-danger btn-sm deleteBtn" data-id="${user.id}">Delete</button>
                        </td>
                    </tr>`;
                });

                $('#userTable').html(rows); // Update the table

                // Fix: Update pagination links dynamically
                let pagination = '';
                for (let i = 1; i <= response.total_pages; i++) {
                    pagination += `<button class="btn btn-primary pagination-btn ${i === page ? 'active' : ''}" data-page="${i}">${i}</button> `;
                }
                $('#pagination').html(pagination);
            }
        });
    }

    // Search Users
    $('#searchInput').on('keyup', function () {
        let searchValue = $(this).val();
        let limit = $('#itemsPerPage').val();
        fetchUsers(searchValue, 1, limit);
    });

    // Change items per page
    $('#itemsPerPage').on('change', function () {
        let searchValue = $('#searchInput').val();
        let limit = $(this).val();
        fetchUsers(searchValue, 1, limit);
    });

    // Pagination Click Event
    $(document).on('click', '.pagination-btn', function () {
        let page = $(this).data('page');
        let searchValue = $('#searchInput').val();
        let limit = $('#itemsPerPage').val();
        fetchUsers(searchValue, page, limit);
    });

    // Add User
    $('#userForm').submit(function (e) {
        e.preventDefault();
        let formData = {
            name: $('#name').val(),
            email: $('#email').val()
        };

        $.post('api.php?action=insert', formData, function () {
            $('#userForm')[0].reset();
            fetchUsers();
        });
    });

    // Open Edit Modal
    $(document).on('click', '.editBtn', function () {
        let id = $(this).data('id');
        $.get('api.php?action=getUser&id=' + id, function (user) {
            $('#editId').val(user.id);
            $('#editName').val(user.name);
            $('#editEmail').val(user.email);
            $('#editModal').modal('show');
        });
    });

    // Update User
    $('#editForm').submit(function (e) {
        e.preventDefault();
        let formData = {
            id: $('#editId').val(),
            name: $('#editName').val(),
            email: $('#editEmail').val()
        };

        $.post('api.php?action=update', formData, function () {
            $('#editModal').modal('hide');
            fetchUsers();
        });
    });

    // Delete User
    $(document).on('click', '.deleteBtn', function () {
        if (confirm('Are you sure?')) {
            let id = $(this).data('id');
            $.post('api.php?action=delete', { id: id }, function () {
                fetchUsers();
            });
        }
    });
});
