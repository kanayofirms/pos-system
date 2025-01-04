<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MemberModel;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        return view('member.list');
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
