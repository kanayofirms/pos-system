<?php

namespace App\Http\Controllers;

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
}
