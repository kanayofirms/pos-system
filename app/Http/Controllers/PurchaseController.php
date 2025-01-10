<?php

namespace App\Http\Controllers;

use App\Models\PurchaseModel;
use Illuminate\Http\Request;
use App\Models\SupplierModel;

class PurchaseController extends Controller
{
    public function index(Request $request)
    {
        return view('purchase.list');
    }

    public function add()
    {
        $data['getRecord'] = SupplierModel::get();
        return view('purchase.add', $data);
    }

    public function store(Request $request)
    {
        $save = new PurchaseModel;
        $save->supplier_id = trim($request->supplier_id);
        $save->total_item = trim($request->total_item);
        $save->total_price = trim($request->total_price);
        $save->discount = trim($request->discount);
        $save->save();

        return redirect('admin/purchase')->with('success', 'Purchase successfully created.');
    }
}
