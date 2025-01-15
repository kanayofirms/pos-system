@extends('layouts.app')

@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Sales</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Sales</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">

                        {{-- Search start --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Search Purchase</h3>
                            </div>
                            <form action="" method="GET">
                                <div class="card-body">
                                    <div class="row">

                                        <div class="form-group col-md-1">
                                            <label>ID</label>
                                            <input type="text" value="{{ Request()->id }}" name="id"
                                                class="form-control" placeholder="ID">
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label>Member Name</label>
                                            <input type="text" value="{{ Request()->member_id }}" name="member_id"
                                                class="form-control" placeholder="Member Name">
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label>Total Item</label>
                                            <input type="text" value="{{ Request()->total_item }}" name="total_item"
                                                class="form-control" placeholder="Total Item">
                                        </div>

                                        <div class="form-group col-md-2">
                                            <label>Accepted</label>
                                            <select name="accepted" class="form-control">
                                                <option value="">Select Accepted</option>
                                                <option {{ Request()->accepted == 'Yes' ? 'selected' : '' }} value="Yes">
                                                    Yes</option>
                                                <option {{ Request()->accepted == 'No' ? 'selected' : '' }} value="No">
                                                    No</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label>Username</label>
                                            <input type="text" value="{{ Request()->user_id }}" name="user_id"
                                                class="form-control" placeholder="Username">
                                        </div>



                                        <div style="clear:both;"></div>
                                        <div class="col-md-12" style="margin-top: 15px;">
                                            <button class="btn btn-primary" type="submit">Search</button>
                                            <a href="{{ url('admin/sales') }}" class="btn btn-success">Reset</a>
                                        </div>

                                    </div>
                                </div>
                            </form>
                        </div>
                        <br>
                        {{-- Search end --}}

                        @include('_message')

                        <div class="card mb-4">
                            <div class="card-header">
                                <h3 class="card-title">Sales List</h3>
                                <div class="card-tools">
                                    <ul class="pagination pagination-sm float-end">
                                        <a href="{{ url('admin/sales/all_delete') }}" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this option item?')">Truncate</a>
                                        &nbsp;
                                        &nbsp;
                                        <a href="{{ url('admin/sales/add') }}" class="btn btn-sm btn-primary">Add
                                            Sales</a>
                                    </ul>
                                </div>
                            </div>

                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Member Name</th>
                                            <th>Total Item</th>
                                            <th>Total Price</th>
                                            <th>Discount</th>
                                            <th>Accepted</th>
                                            <th>Username</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @forelse ($getRecord as $value)
                                            <tr>
                                                <td>{{ $value->id }}</td>
                                                <td>{{ $value->name_member }}</td>
                                                <td>{{ $value->total_item }}</td>
                                                <td>{{ number_format($value->total_price, 2) }}</td>
                                                <td>{{ number_format($value->discount, 2) }} %</td>
                                                <td>{{ $value->accepted }}</td>
                                                <td>{{ $value->name }}</td>
                                                <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>
                                                <td>{{ date('d-m-Y H:i A', strtotime($value->updated_at)) }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-between gap-2">
                                                        <a href="{{ url('admin/sales/edit/' . $value->id) }}"
                                                            class="btn btn-sm btn-success">
                                                            Edit
                                                        </a>

                                                        <a href="{{ url('admin/sales/delete/' . $value->id) }}"
                                                            class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Are you sure you want to delete?')">
                                                            Delete
                                                        </a>
                                                    </div>
                                                </td>

                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center">No Record Found.</td>
                                            </tr>
                                        @endforelse

                                    </tbody>
                                </table>
                                <div style="padding: 10px; float: right;">
                                    {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
