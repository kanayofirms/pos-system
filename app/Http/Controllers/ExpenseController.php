<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExpenseModel;

class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        $getRecord = ExpenseModel::orderBy('id', 'desc');

        // Search start
        if ($request->id) {
            $getRecord = $getRecord->where('id', '=', $request->id);
        }

        if ($request->description) {
            $getRecord = $getRecord->where('description', 'like', '%' . $request->description . '%');
        }

        if ($request->amount) {
            $getRecord = $getRecord->where('amount', 'like', '%' . $request->amount . '%');
        }

        if ($request->created_at) {
            $getRecord = $getRecord->where('created_at', 'like', '%' . $request->created_at . '%');
        }

        if ($request->updated_at) {
            $getRecord = $getRecord->where('updated_at', 'like', '%' . $request->updated_at . '%');
        }
        // Search start

        $getRecord = $getRecord->paginate(20);
        $data['getRecord'] = $getRecord;
        return view('expense.list', $data);
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
