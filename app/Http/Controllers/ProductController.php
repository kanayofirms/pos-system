<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryModel;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $cartgory = CategoryModel::all()->pluck('category_name', 'id');
        return view('product.list', compact('cartgory'));
    }
}
