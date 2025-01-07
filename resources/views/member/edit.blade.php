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
                            <li class="breadcrumb-item active" aria-current="page">
                                Edit Member
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">
                <div class="row g-4">

                    <div class="col-md-12">

                        <div class="card card-warning card-outline mb-4">
                            <div class="card-header">
                                <div class="card-title">Edit Member</div>
                            </div>
                            <form method="POST" action="{{ url('admin/member/edit/' . $getRecord->id) }}">

                                {{ csrf_field() }}
                                <div class="card-body">
                                    <div class="row mb-3"> <label class="col-sm-2 col-form-label">Member Name</label>
                                        <div class="col-sm-10"> <input type="text" class="form-control"
                                                name="name_member" value="{{ $getRecord->name_member }}"
                                                placeholder="Enter Member Name" required>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Address</label>
                                        <div class="col-sm-10">
                                            <textarea name="address" class="form-control" placeholder="Enter Address" required>{{ $getRecord->address }}</textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-3"> <label class="col-sm-2 col-form-label">Phone Number</label>
                                        <div class="col-sm-10"> <input type="number" name="telephone"
                                                value="{{ $getRecord->telephone }}" class="form-control"
                                                placeholder="Enter Phone Number" required>
                                        </div>
                                    </div>


                                </div>
                                <div class="card-footer"> <button type="submit" class="btn btn-warning">Update</button>
                                    <a href="{{ url('admin/member') }}" class="btn btn-primary float-end">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </main>
@endsection
