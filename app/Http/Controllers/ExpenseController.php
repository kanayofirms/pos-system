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

    public function store(Request $request)
    {
        $save = new ExpenseModel;
        $save->description = trim($request->description);
        $save->amount = trim($request->amount);
        $save->save();

        return redirect('admin/expense')->with('success', 'Expense successfully created.');
    }
}
