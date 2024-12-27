<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        if (Auth::user()->is_role == 1) {
            echo "Admin dashboard";
            die();
        } else if (Auth::user()->is_role == 2) {
            echo "User dashboard";
            die();
        }
    }

}
