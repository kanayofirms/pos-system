@extends('layouts.app')

@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0"></h3>Product
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Product
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <h3 class="card-title">Product List</h3>
                                <div class="card-tools">
                                    <ul class="pagination pagination-sm float-end">
                                        <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#addProductModal">Add Product</a>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="product-table" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Category Name</th>
                                            <th>Product Code</th>
                                            <th>Name Product</th>
                                            <th>Brand</th>
                                            <th>Purchase Price</th>
                                            <th>Selling Price</th>
                                            <th>Discount</th>
                                            <th>Stock</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- dynamic data insert here --}}
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
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel">Add Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="productForm">
                        @csrf
                        <div class="mb-3">
                            <label for="category_name" class="form-label">Category Name</label>
                            <select name="category_id" id="category_id" class="form-control" required>
                                <option value="">Select Category Name</option>
                                @foreach ($cartgory as $key => $item)
                                    <option value="{{ $key }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="product_code" class="form-label">Product Code</label>
                            <input type="text" class="form-control" id="product_code" name="product_code" required>
                        </div>

                        <div class="mb-3">
                            <label for="name_product" class="form-label">Name Product</label>
                            <input type="text" class="form-control" id="name_product" name="name_product" required>
                        </div>

                        <div class="mb-3">
                            <label for="brand" class="form-label">Brand</label>
                            <input type="text" class="form-control" id="brand" name="brand" required>
                        </div>

                        <div class="mb-3">
                            <label for="purchase_price">Purchase Price</label>
                            <input type="number" class="form-control" id="purchase_price" name="purchase_price" required>
                        </div>

                        <div class="mb-3">
                            <label for="selling_price">Selling Price</label>
                            <input type="number" class="form-control" id="selling_price" name="selling_price" required>
                        </div>

                        <div class="mb-3">
                            <label for="discount">Discount</label>
                            <input type="number" class="form-control" id="discount" name="discount" required>
                        </div>

                        <div class="mb-3">
                            <label for="stock">Stock</label>
                            <input type="number" class="form-control" id="stock" name="stock" required>
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
            $('#productForm').on('submit', function(e) {
                e.preventDefault();
                $('.flashMessage').hide();

                const formData = $(this).serialize();

                $.ajax({
                    url: "{{ route('product.store') }}",
                    method: "POST",
                    data: formData,
                    success: function(response) {
                        $('.flashMessage').html(response.message).fadeIn().delay(2000)
                            .fadeOut();
                        $('#productForm')[0].reset();
                        $('#addProductModal').modal('hide');

                        fetchProducts();
                    },
                    error: function(xhr) {
                        const errors = xhr.responseJSON.errors;
                        let errorMessages = '';
                        for (const key in errors) {
                            errorMessages += `<li>${errors[key]}</li>`; // Fixed this line
                        }
                        $('.flashMessage')
                            .addClass('alert-danger')
                            .html(`<ul>${errorMessages}</ul>`)
                            .fadeIn();
                    }
                });
            });
        });

        function fetchProducts() {
            $.ajax({
                url: "{{ route('product.fetch') }}",
                method: "GET",
                success: function(response) {
                    const tbody = $('#product-table tbody');
                    tbody.empty();

                    if (Array.isArray(response)) {
                        response.forEach((product, index) => {
                            const row = `
<tr>
    <td>${index + 1}</td>
    <td>${product.category ? product.category.category_name : 'N/A'}</td>
    <td>${product.product_code || 'N/A'}</td>
    <td>${product.name_product || 'N/A'}</td>
    <td>${product.brand || 'N/A'}</td>
    <td>${product.purchase_price || 'N/A'}</td>
    <td>${product.selling_price || 'N/A'}</td>
    <td>${product.discount || 'N/A'}</td>
    <td>${product.stock || 'N/A'}</td>
    <td>${product.created_at ? dayjs(product.created_at).format('YYYY-MM-DD') : 'N/A'}</td>
    <td>${product.updated_at ? dayjs(product.updated_at).format('YYYY-MM-DD') : 'N/A'}</td>
    <td>
        <button class="btn btn-sm btn-warning edit-btn" data-id="${product.id}">Edit</button>  
        <button class="btn btn-sm btn-danger delete-btn" data-id="${product.id}">Delete</button>  
    </td>
</tr>`;
                            tbody.append(row);

                            $('.edit-btn').on('click', handleEdit);
                        });
                    } else {
                        alert('Unexpected response format.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching products:', status, error);
                    alert('Failed to fetch product.');
                }
            });
        }

        // Edit product
        function handleEdit() {
            const id = $(this).data('id');
            $.ajax({
                url: `{{ url('admin/product/edit') }}/${id}`,
                method: "GET",
                success: function(response) {
                    $('#category_id').val(response.category_id);
                    $('#product_code').val(response.product_code);
                    $('#name_product').val(response.name_product);
                    $('#brand').val(response.brand);
                    $('#purchase_price').val(response.purchase_price);
                    $('#selling_price').val(response.selling_price);
                    $('#discount').val(response.discount);
                    $('#stock').val(response.stock);
                    $('#addProductModal').modal('show');

                    // Unbind previous submit handler before attaching a new one
                    $('#productForm').off('submit').on('submit', function(e) {
                        e.preventDefault();
                        const formData = $(this).serialize();
                        $.ajax({
                            url: `{{ url('admin/product/update') }}/${id}`,
                            type: "POST",
                            data: formData,

                            success: function(response) {
                                $('.flashMessage').html(response.message).fadeIn().delay(
                                    2000).fadeOut();
                                $('#productForm')[0].reset();
                                $('#addProductModal').modal('hide');
                                fetchProducts();
                            },
                            error: function(xhr) {
                                alert('Failed to update product: ' + xhr.responseText);
                            }
                        });
                    });
                },
                error: function() {
                    alert('Failed to fetch product data');
                }
            });
        }


        // Fetch products on page load
        $(document).ready(function() {
            fetchProducts();
            // Example for event delegation
            $(document).on('click', '.edit-btn', function() {
                const productId = $(this).data('id');
                console.log('Edit product:', productId);
            });

            $(document).on('click', '.delete-btn', function() {
                const productId = $(this).data('id');
                console.log('Delete product:', productId);
            });
        });
    </script>
@endsection
