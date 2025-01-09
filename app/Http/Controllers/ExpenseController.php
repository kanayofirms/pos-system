<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExpenseModel;

class ExpenseController extends Controller
{
    public function index()
    {
        return view('expense.list');
    }

    public function add(Request $request)
    {
        return view('expense.add');
    }
}
