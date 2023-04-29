<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    
    

</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Submit Form</h3>
                    </div>
                    <div class="card-body">
                        <form action="/add/data" method="post" enctype="multipart/form-data" id="add_data">
                            <?= csrf_field() ?>
                            <!-- username -->
                            <div class="row mb-2">
                                <div class="col-12 col-md-4">
                                    <strong><span>Name</span></strong>
                                    <br>
                                </div>
                                <div class="col-12 col-md-8">
                                <input class="form-control" type="text" name="name" id="name">
                                </div>
                            </div>
                            <!-- / -->

                            <!-- email -->
                            <div class="row mb-2">
                                <div class="col-12 col-md-4">
                                    <strong><span>Email</span></strong>
                                    <br>
                                </div>
                                <div class="col-12 col-md-8">
                                <input class="form-control" type="email" name="email" id="email">
                                </div>
                            </div>
                            <!-- / -->

                            <!-- no_hp -->
                            <div class="row mb-2">
                                <div class="col-12 col-md-4">
                                    <strong><span>No. Hp</span></strong>
                                    <br>
                                </div>
                                <div class="col-12 col-md-8">
                                <input class="form-control" type="number" name="no_hp" id="no_hp">
                                </div>
                            </div>
                            <!-- / -->

                            <!-- submit button -->
                            <div class="row mb-2">
                                <div class="col-12 col-md-4"></div>
                                <div class="col-12 col-md-8">
                                    <button type="button" class="btn btn-dark" onclick="submitForm()">Submit</button>
                                </div>
                            </div>
                            <!-- / -->
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">List Data</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="list-data" class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>No. Hp</th>
                                        <th>Created_at</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="modal fade" id="success-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Success!</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            Your data has been successfully submitted.
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                <div class="form-group">
                    <label for="editName">Name</label>
                    <input type="text" class="form-control" id="editName" name="name">
                </div>
                <div class="form-group">
                    <label for="editEmail">Email</label>
                    <input type="email" class="form-control" id="editEmail" name="email">
                </div>
                <div class="form-group">
                    <label for="editNoHp">No. HP</label>
                    <input type="tel" class="form-control" id="editNoHp" name="no_hp">
                </div>
                <input type="hidden" id="editId" name="id">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="editSubmit">Save changes</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete Data</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this data?
                <form id="deleteForm">
                <div class="form-group">
                    <label for="editName">Name</label>
                    <input type="text" class="form-control" id="deleteName" name="name" disabled>
                </div>
                <input type="hidden" id="deleteId" name="id">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" id="deleteSubmit">Delete</button>
            </div>
        </div>
    </div>
</div>

</body>
<!-- Add this code at the end of the body -->
<script>
    function submitForm() {
        $.ajax({
            url: "/add/data",
            method: "POST",
            data: $("#add_data").serialize(),
            success: function(data) {
            $("#success-modal").modal("show");
            // clear form fields after submission
            $("#name").val("");
            $("#email").val("");
            $("#no_hp").val("");
            refreshTable();
            }
        });
    }

    $(document).ready(function() {
        var table = $('#list-data').DataTable({
            "ajax": {
                "url": "/data/json",
                "dataSrc": ""
            },
            "columns": [
                { "data": "id" },
                { "data": "name" },
                { "data": "email" },
                { "data": "no_hp" },
                { "data": "created_at" },
                {
                    "data": null,
                    "render": function(data, type, row) {
                        return '<button type="button" class="btn btn-primary edit-btn" data-bs-toggle="modal" data-bs-target="#editModal" data-id="' + row.id + '">Edit</button> <button type="button" class="btn btn-danger delete-btn" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="' + row.id + '">Delete</button>';
                    }
                }
            ]
        });
    });

    function refreshTable() {
        $("#list-data").DataTable().ajax.reload();
    }

    // Add an event listener for the edit button
    $('#list-data').on('click', '.edit-btn', function() {
        var id = $(this).data('id');
        
        // Send an AJAX request to get the data for the row with the specified id
        $.ajax({
            url: '/data/get/' + id,
            method: 'GET',
            success: function(data) {
                // Populate the edit form fields
                $('#editId').val(data.id);
                $('#editName').val(data.name);
                $('#editEmail').val(data.email);
                $('#editNoHp').val(data.no_hp);

                // Open the edit modal
                $('#editModal').modal('show');
            }
        });
    });

    // Add an event listener for the "Save changes" button
    $('#editSubmit').click(function() {
        var id = $('#editId').val();
        // Send an AJAX request to update the data
        $.ajax({
            url: '/data/update/' + id,
            method: 'POST',
            data: $('#editForm').serialize(),
            success: function() {
                // Close the modal
                $('#editModal').modal('hide');

                // Refresh the table
                refreshTable();
            }
        });
    });

    // Add an event listener for the delete button
    $('#list-data').on('click', '.delete-btn', function() {
        var id = $(this).data('id');
        
        // Send an AJAX request to get the data for the row with the specified id
        $.ajax({
            url: '/data/get/' + id,
            method: 'GET',
            success: function(data) {
                // Populate the delete form fields
                $('#deleteId').val(data.id);
                $('#deleteName').val(data.name);

                // Open the delete modal
                $('#deleteModal').modal('show');
            }
        });
    });

    // Add an event listener for the "Delete" button
    $('#deleteSubmit').click(function() {
        var id = $('#deleteId').val();
        // Send an AJAX request to delete the data
        $.ajax({
            url: '/data/delete/' + id,
            method: 'GET',
            data: $('#deleteForm').serialize(),
            success: function() {
                // Close the modal
                $('#deleteModal').modal('hide');

                // Refresh the table
                refreshTable();
            }
        });
    });
    
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>