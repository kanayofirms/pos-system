@extends('layouts.app')

@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Purchase</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Edit Purchase
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
                                <div class="card-title">Edit Purchase</div>
                            </div>
                            <form method="POST" action="{{ url('admin/purchase/edit/'.$getRecordValue->id) }}">

                                {{ csrf_field() }}
                                <div class="card-body">
                                    <div class="row mb-3"> <label class="col-sm-2 col-form-label">Supplier Name</label>
                                        <div class="col-sm-10">
                                            <select name="supplier_id" class="form-control" required>
                                                @foreach ($getRecord as $value)
                                                    <option {{ ($value->id == $getRecordValue->supplier_id) ? 'selected' : '' }}
                                                        value="{{ $value->id }}">{{ $value->supplier_name }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3"> <label class="col-sm-2 col-form-label">Total Item</label>
                                        <div class="col-sm-10"> <input type="number" name="total_item"
                                                value="{{ $getRecordValue->total_item }}" class="form-control"
                                                placeholder="Enter Total Item" required>
                                        </div>
                                    </div>

                                    <div class="row mb-3"> <label class="col-sm-2 col-form-label">Total Price</label>
                                        <div class="col-sm-10"> <input type="number" name="total_price"
                                                value="{{ $getRecordValue->total_price }}" class="form-control"
                                                placeholder="Enter Total Price" required>
                                        </div>
                                    </div>

                                    <div class="row mb-3"> <label class="col-sm-2 col-form-label">Discount</label>
                                        <div class="col-sm-10"> <input type="number" name="discount"
                                                value="{{ $getRecordValue->discount }}" class="form-control"
                                                placeholder="Enter Discount" required>
                                        </div>
                                    </div>


                                </div>
                                <div class="card-footer"> <button type="submit" class="btn btn-warning">Update</button>
                                    <a href="{{ url('admin/purchase') }}" class="btn btn-primary float-end">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </main>
@endsection
