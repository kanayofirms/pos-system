@extends('layouts.app')

@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Expense</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Edit Expense
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
                                <div class="card-title">Edit Expense</div>
                            </div>
                            <form method="POST" action="{{ url('admin/expense/edit/' . $getRecord->id) }}">

                                {{ csrf_field() }}
                                <div class="card-body">

                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label">Description</label>
                                        <div class="col-sm-10">
                                            <textarea name="description" class="form-control" placeholder="Enter Description" required>{{ $getRecord->description }}</textarea>
                                        </div>
                                    </div>


                                    <div class="row mb-3"> <label class="col-sm-2 col-form-label">Amount</label>
                                        <div class="col-sm-10"> <input type="number" class="form-control"
                                                value="{{ $getRecord->amount }}" name="amount" placeholder="Enter Amount"
                                                required>
                                        </div>
                                    </div>

                                </div>
                                <div class="card-footer"> <button type="submit" class="btn btn-warning">Update</button>
                                    <a href="{{ url('admin/expense') }}" class="btn btn-primary float-end">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </main>
@endsection
