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

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
        ]);

        $category = new CategoryModel();
        $category->category_name = $request->category_name;
        $category->save();

        return response()->json(['success' => 'Category added successfully.']);
    }
}
