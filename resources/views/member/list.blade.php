@extends('layouts.app')

@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Member</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Member</li>
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
                                <h3 class="card-title">Search Member</h3>
                            </div>
                            <form action="" method="GET">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-1">
                                            <label for="">ID</label>
                                            <input type="text" value="{{ Request()->id }}" name="id"
                                                class="form-control" placeholder="ID">
                                        </div>

                                        <div class="form-group col-md-2">
                                            <label for="">Code Member</label>
                                            <input type="text" value="{{ Request()->code_member }}" name="code_member"
                                                class="form-control" placeholder="Enter Code Member">
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label for="">Name Member</label>
                                            <input type="text" value="{{ Request()->name_member }}" name="name_member"
                                                class="form-control" placeholder="Enter Name Member">
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label>Address</label>
                                            <input type="text" value="{{ Request()->address }}" name="address"
                                                class="form-control" placeholder="Enter Address">
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label>Telephone</label>
                                            <input type="number" value="{{ Request()->telephone }}" name="telephone"
                                                class="form-control" placeholder="Enter Telephone">
                                        </div>

                                        <div class="form-group col-md-3" style="margin-top: 15px;">
                                            <label>Created At</label>
                                            <input type="date" value="{{ Request()->created_at }}" name="created_at"
                                                class="form-control">
                                        </div>

                                        <div class="form-group col-md-3" style="margin-top: 15px;">
                                            <label>Updated At</label>
                                            <input type="date" value="{{ Request()->updated_at }}" name="updated_at"
                                                class="form-control">
                                        </div>

                                        <div style="clear:both;"></div>

                                        <div class="col-md-12" style="margin-top: 15px;">
                                            <button class="btn btn-primary" type="submit">Search</button>
                                            <a href="{{ url('admin/member') }}" class="btn btn-success">Reset</a>
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
                                <h3 class="card-title">Member List</h3>
                                <div class="card-tools">
                                    <ul class="pagination pagination-sm float-end">
                                        <a href="{{ url('admin/member/add') }}" class="btn btn-sm btn-primary">Add
                                            Member</a>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Code Member</th>
                                            <th>Name Member</th>
                                            <th>Address</th>
                                            <th>Telephone</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($getRecord as $value)
                                            <tr>
                                                <td>{{ $value->id }}</td>
                                                <td>{{ $value->code_member }}</td>
                                                <td>{{ $value->name_member }}</td>
                                                <td>{{ $value->address }}</td>
                                                <td>{{ $value->telephone }}</td>
                                                <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>
                                                <td>{{ date('d-m-Y H:i A', strtotime($value->updated_at)) }}</td>
                                                <td>
                                                    <!-- Add actions here, e.g., Edit/Delete buttons -->
                                                    <a href="{{ url('admin/member/edit/' . $value->id) }}"
                                                        class="btn btn-sm btn btn-success">Edit</a>

                                                    <a href="{{ url('admin/member/delete/' . $value->id) }}"
                                                        class="btn btn-sm btn btn-danger"
                                                        onclick="return confirm('Are you sure you want to delete?')">Delete</a>
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
