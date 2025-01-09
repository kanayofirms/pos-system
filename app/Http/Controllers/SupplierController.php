<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SupplierModel;

class SupplierController extends Controller
{
    public function index()
    {
        $data['getRecord'] = SupplierModel::getRecord();
        return view('supplier.list', $data);
    }

    public function delete($id)
    {
        $deleteRecord = SupplierModel::getSingle($id);
        $deleteRecord->delete();

        return redirect('admin/supplier')->with('error', 'Supplier successfully deleted.');
    }

    public function add(Request $request)
    {
        return view('supplier.add');
    }

    public function store(Request $request)
    {
        SupplierModel::recordInsert($request);

        return redirect('admin/supplier')->with('success', 'Supplier successfully added.');
    }

    public function edit($id)
    {
        // Get the supplier record by ID
        $data['getRecord'] = SupplierModel::getSingle($id);



        // Return the edit view with the record
        return view('supplier.edit', $data);
    }

    public function update($id, Request $request)
    {
        SupplierModel::recordUpdate($id, $request);

        return redirect('admin/supplier')->with('success', 'Record successfully updated.');
    }
}
