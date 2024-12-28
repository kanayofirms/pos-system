<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryModel;

class categoryController extends Controller
{
    public function index(Request $request)
    {
        return view('category.list');
    }

    public function getCategories()
    {
        $categories = CategoryModel::get();

        return response()->json($categories);
    }
}
