<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index(Request $request)
    {
        return view('purchase.list');
    }

    public function add()
    {
        return view('purchase.add');
    }
}
