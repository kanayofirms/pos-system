@extends('layouts.app')

@section('content')
    <main class="app-main">
        <div class="app-content-header"> <!--begin::Container-->
            <div class="container-fluid"> <!--begin::Row-->
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0"></h3>Category
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Category
                            </li>
                        </ol>
                    </div>
                </div> <!--end::Row-->
            </div> <!--end::Container-->
        </div>

        <div class="app-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h3 class="card-title">Category List</h3>
                                <div class="card-tools">
                                    <ul class="pagination pagination-sm float-end">
                                        <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#addCategoryModal">Add Category</a>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="category-table" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Category Name</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- dynamic data insert --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>



    {{-- Modal start --}}
    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryModalLabel">Add Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="categoryForm">
                        @csrf
                        <div class="mb-3">
                            <label for="category_name" class="form-label">Category Name</label>
                            <input type="text" class="form-control" id="category_name" name="category_name" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal end --}}

    <div class="flashMessage alert alert-success" style="display: none;"></div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/dayjs/dayjs.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            fetchCategories();

            function fetchCategories() {
                $.ajax({
                    url: "{{ url('admin/category/data') }}",
                    type: "GET",
                    success: function(response) {
                        let tableBody = '';
                        if (response && response.length > 0) {
                            $.each(response, function(index, category) {
                                let createdAt = dayjs(category.created_at).format(
                                    'MM-DD-YYYY h:mm A');
                                let updatedAt = dayjs(category.updated_at).format(
                                    'MMM DD, YYYY h:mm A');
                                tableBody += `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${category.category_name}</td>
                                <td>${createdAt}</td>
                                <td>${updatedAt}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm edit-btn" data-id="${category.id}">Edit</button>
                                    <button class="btn btn-danger btn-sm delete-btn" data-id="${category.id}">Delete</button>
                                </td>
                            </tr>
                        `;
                            });
                        } else {
                            tableBody = `
                        <tr>
                            <td colspan="5" class="text-center">No categories available</td>
                        </tr>
                    `;
                        }
                        $('#category-table tbody').html(tableBody);

                        // Attach event for the edit button
                        $('.edit-btn').on('click', handleEdit);
                        // Attach event for the delete button
                        $('.delete-btn').on('click', handleDelete);
                    },
                    error: function(xhr) {
                        console.error('Failed to fetch categories:', xhr.responseText);
                    }
                });
            }

            // Edit
            function handleEdit() {
                const id = $(this).data('id');
                $.ajax({
                    url: `{{ url('admin/category/edit') }}/${id}`,
                    type: "GET",
                    success: function(category) {
                        $('#category_name').val(category.category_name); // Corrected line
                        $('#addCategoryModal').modal('show');

                        // Update category on form submit
                        $('#categoryForm').off('submit').on('submit', function(e) {
                            e.preventDefault();
                            const formData = $(this).serialize();
                            $.ajax({
                                url: `{{ url('admin/category/update') }}/${id}`,
                                type: "POST",
                                data: formData,
                                success: function(response) {
                                    $('#addCategoryModal').modal('hide');
                                    fetchCategories
                                        (); // Fetch categories again after updating
                                    $('.flashMessage')
                                        .text(response.success)
                                        .fadeIn()
                                        .delay(3000)
                                        .fadeOut();
                                },
                                error: function(xhr) {
                                    alert('Failed to update category.');
                                }
                            });
                        });
                    },
                    error: function(xhr) {
                        alert('Failed to fetch category details.');
                    }
                });
            }

            // delete
            function handleDelete() {
                const id = $(this).data('id');
                if (confirm('Are you sure you want to delete this category?')) {
                    $.ajax({
                        url: `{{ url('admin/category/delete') }}/${id}`,
                        type: "POST", // Laravel often uses POST with a _method override for DELETE
                        data: {
                            _token: "{{ csrf_token() }}",
                            _method: "DELETE" // Indicates the intended HTTP method
                        },
                        success: function(response) {
                            fetchCategories(); // Refresh the category list

                            $('.flashMessage')
                                .text(response.success)
                                .fadeIn()
                                .delay(3000)
                                .fadeOut();

                            setTimeout(() => {
                                location.reload();
                            }, 2000);
                        },
                        error: function(xhr) {
                            alert('Failed to delete category.');
                        }
                    });
                }
            }

        });
    </script>

    <script>
        $(document).ready(function() {
            $('#categoryForm').on('submit', function(e) {
                e.preventDefault();
                let formData = $(this).serialize();
                $.ajax({
                    url: "{{ url('admin/category/store') }}",
                    type: "POST",
                    data: formData,
                    success: function(response) {
                        $('#addCategoryModal').modal('hide');
                        $('#categoryForm')[0].reset();

                        $('.flashMessage')
                            .text(response.success)
                            .fadeIn()
                            .delay(3000)
                            .fadeOut();

                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON.errors;
                        let errorMessage = '';
                        $.each(errors, function(key, value) {
                            errorMessage += value[0] + '\n';
                        });
                        alert(errorMessage);
                    },
                });
            });
        });
    </script>
@endsection
