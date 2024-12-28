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
                            </div>
                            <div class="card-body">
                                <table id="category-table" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Category Name</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
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
                                </tr>
                            `;
                            });
                        } else {
                            tableBody = `
                            <tr>
                                <td colspan="4" class="text-center">No categories available</td>
                            </tr>
                        `;
                        }
                        $('#category-table tbody').html(tableBody);
                    },
                    error: function(xhr) {
                        console.error('Failed to fetch categories:', xhr.responseText);
                    }
                });
            }
        });
    </script>
@endsection
