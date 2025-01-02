<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryModel;
use App\Models\ProductModel;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $cartgory = CategoryModel::all()->pluck('category_name', 'id');
        return view('product.list', compact('cartgory'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:category,id',
            'product_code' => 'required|string|max:255|unique:product,product_code',
            'name_product' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'purchase_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'discount' => 'required|numeric|min:0|max:100',
            'stock' => 'required|integer|min:0',
        ]);

        ProductModel::create($validated);  // Corrected this line
        return response()->json(['message' => 'Product successfully added.']);
    }

    public function fetchProducts()
    {
        $products = ProductModel::with('category')->get();
        return response()->json($products);
    }

    public function edit($id)
    {
        $product = ProductModel::findOrFail($id);
        return response()->json($product);
    }

}
