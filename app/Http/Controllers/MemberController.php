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
        $save = new MemberModel;
        $save->name_member = trim($request->name_member);
        $save->address = trim($request->address);
        $save->telephone = trim($request->telephone);
        $save->save();

        return redirect('admin/member')->with('success', "Member successfully created.");
    }
}
