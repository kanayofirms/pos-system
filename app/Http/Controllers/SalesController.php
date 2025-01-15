<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalesModel;

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
}
