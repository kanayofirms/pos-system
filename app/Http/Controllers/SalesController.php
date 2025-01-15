<?php

namespace App\Http\Controllers;

use App\Models\MemberModel;
use Illuminate\Http\Request;
use App\Models\SalesModel;
use App\Models\User;

class SalesController extends Controller
{
    public function index(Request $request)
    {
        $data['getRecord'] = SalesModel::select('sales.*', 'member.name_member', 'users.name')
            ->join('member', 'member.id', '=', 'sales.member_id')
            ->join('users', 'users.id', '=', 'sales.user_id')
            ->get();
        return view('sales.list', $data);
    }

    public function add(Request $request)
    {
        $data['getMember'] = MemberModel::get();
        $data['getUser'] = User::where('is_role', '=', 2)->get();
        return view('sales.add', $data);
    }

    public function store(Request $request)
    {
        $save = new SalesModel;
        $save->member_id = trim($request->member_id);
        $save->total_item = trim($request->total_item);
        $save->total_price = trim($request->total_price);
        $save->discount = trim($request->discount);
        $save->accepted = trim($request->accepted);
        $save->user_id = trim($request->user_id);
        $save->save();

        return redirect('admin/sales')->with('success', 'Sales successfully created.');
    }

    public function edit($id)
    {
        $data['getMember'] = MemberModel::get();
        $data['getUser'] = User::where('is_role', '=', 2)->get();
        $data['getEdit'] = SalesModel::find($id);
        return view('sales.edit', $data);
    }

    public function update($id, Request $request)
    {
        $save = SalesModel::find($id);
        $save->member_id = trim($request->member_id);
        $save->total_item = trim($request->total_item);
        $save->total_price = trim($request->total_price);
        $save->discount = trim($request->discount);
        $save->accepted = trim($request->accepted);
        $save->user_id = trim($request->user_id);
        $save->save();

        return redirect('admin/sales')->with('success', 'Sales successfully updated.');
    }

    public function delete($id)
    {
        SalesModel::find($id)->delete();
        return redirect()->back()->with('error', 'Record successfully deleted.');
    }
}
