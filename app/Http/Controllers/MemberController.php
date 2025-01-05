<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MemberModel;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        // $data['getRecord'] = MemberModel::get();
        // $data['getRecord'] = MemberModel::orderBy('id', 'desc')->paginate(20);
        $getRecord = MemberModel::orderBy('id', 'desc');

        // Search start
        if ($request->id) {
            $getRecord = $getRecord->where('id', '=', $request->id);
        }

        if ($request->code_member) {
            $getRecord = $getRecord->where('code_member', '=', $request->code_member);
        }

        if ($request->name_member) {
            $getRecord = $getRecord->where('name_member', 'like', '%' . $request->name_member . '%');
        }

        if ($request->address) {
            $getRecord = $getRecord->where('address', 'like', '%' . $request->address . '%');
        }

        if ($request->telephone) {
            $getRecord = $getRecord->where('telephone', 'like', '%' . $request->telephone . '%');
        }

        if ($request->created_at) {
            $getRecord = $getRecord->where('created_at', 'like', '%' . $request->created_at . '%');
        }


        if ($request->updated_at) {
            $getRecord = $getRecord->where('updated_at', 'like', '%' . $request->updated_at . '%');
        }

        // Search end

        $getRecord = $getRecord->paginate(30);
        $data['getRecord'] = $getRecord;

        return view('member.list', $data);
    }

    public function add()
    {
        return view('member.add');
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name_member' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'telephone' => 'required|string|max:15',
        ]);

        // Get the latest member and calculate the next code_member
        $lastMember = MemberModel::latest()->first();
        $code_member = $lastMember ? (int) $lastMember->code_member + 1 : 1;

        // Create a new member and save it to the database
        $save = new MemberModel();
        $save->code_member = str_pad($code_member, 5, '0', STR_PAD_LEFT);
        $save->name_member = trim($request->name_member);
        $save->address = trim($request->address);
        $save->telephone = trim($request->telephone);
        $save->save();

        // Redirect with success message
        return redirect('admin/member')->with('success', 'Member successfully created.');
    }

}
