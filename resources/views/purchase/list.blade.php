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
                            <li class="breadcrumb-item active" aria-current="page">Purchase</li>
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
                                            <label>Supplier Name</label>
                                            <input type="text" value="{{ Request()->supplier_id }}" name="supplier_id"
                                                class="form-control" placeholder="Supplier Name">
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label>Total Item</label>
                                            <input type="text" value="{{ Request()->total_item }}" name="total_item"
                                                class="form-control" placeholder="Total Item">
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label>Price</label>
                                            <input type="text" value="{{ Request()->total_price }}" name="total_price"
                                                class="form-control" placeholder="Price">
                                        </div>

                                        <div class="form-group col-md-2">
                                            <label>Discount</label>
                                            <input type="text" value="{{ Request()->discount }}" name="discount"
                                                class="form-control" placeholder="Discount">
                                        </div>

                                        <div style="clear:both;"></div>
                                        <div class="col-md-12" style="margin-top: 15px;">
                                            <button class="btn btn-primary" type="submit">Search</button>
                                            <a href="{{ url('admin/purchase') }}" class="btn btn-success">Reset</a>
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
                                <h3 class="card-title">Purchase List</h3>
                                <div class="card-tools">
                                    <ul class="pagination pagination-sm float-end">
                                        <a href="{{ url('admin/purchase/add') }}" class="btn btn-sm btn-primary">Add
                                            Purchase</a>
                                    </ul>
                                </div>
                            </div>

                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Supplier Name</th>
                                            <th>Total Item</th>
                                            <th>Price</th>
                                            <th>Discount</th>
                                            <th>Net Discount</th>
                                            <th>Total Price</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $totalItem = 0;
                                            $totalPR = 0;
                                            $totalDiscount = 0;
                                            $totalNet = 0;
                                            $totalP = 0;
                                        @endphp
                                        @forelse ($getRecord as $value)
                                            @php
                                                $NetDiscount = ($value->total_price * $value->discount) / 100;
                                                $TotalPrice = $value->total_price - $NetDiscount;
                                                $totalItem = $totalItem + $value->total_item;
                                                $totalPR = $totalPR + $value->total_price;
                                                $totalDiscount = $totalDiscount + $value->discount;
                                                $totalNet = $totalNet + $NetDiscount;
                                                $totalP = $totalP + $TotalPrice;
                                            @endphp
                                            <tr>
                                                <td>{{ $value->id }}</td>
                                                <td>{{ $value->supplier_name }}</td>
                                                <td>{{ $value->total_item }}</td>
                                                <td>{{ number_format($value->total_price, 2) }}</td>
                                                <td>{{ number_format($value->discount, 2) }} %</td>
                                                <td>{{ number_format($NetDiscount, 2) }}</td>
                                                <td>{{ number_format($TotalPrice, 2) }}</td>
                                                <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>
                                                <td>{{ date('d-m-Y H:i A', strtotime($value->updated_at)) }}</td>
                                                <td class="d-flex justify-content-between">
                                                    <!-- Add actions here, e.g., Edit/Delete buttons -->
                                                    <a href="{{ url('admin/purchase/edit/' . $value->id) }}"
                                                        class="btn btn-sm btn btn-success">Edit</a>

                                                    <a href="{{ url('admin/purchase/delete/' . $value->id) }}"
                                                        class="btn btn-sm btn btn-danger"
                                                        onclick="return confirm('Are you sure you want to delete?')">Delete</a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center">No Record Found.</td>
                                            </tr>
                                        @endforelse
                                        <tr>
                                            <th colspan="2">All Total</th>
                                            <td>{{ $totalItem }}</td>
                                            <td>{{ number_format($totalPR, 2) }}</td>
                                            <td>{{ number_format($totalDiscount, 2) }} %</td>
                                            <td>{{ number_format($totalNet, 2) }}</td>
                                            <td>{{ number_format($totalP, 2) }}</td>
                                            <th colspan="3"></th>
                                        </tr>
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
