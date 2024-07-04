<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Display a listing of the products
    public function index()
    {
        $products = Product::with('shop', 'category', 'productImages', 'attributes')->get();
        return response()->json($products);
    }

    // Store a newly created product in storage
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug',
            'shop_id' => 'required|exists:shops,id',
            'category_id' => 'required|exists:categories,id',
            'primary_image' => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'required|boolean',
        ]);

        $product = Product::create($validatedData);

        return response()->json($product, 201);
    }

    // Display the specified product
    public function show($id)
    {
        $product = Product::with('shop', 'category', 'productImages', 'attributes')->findOrFail($id);
        return response()->json($product);
    }

    // Update the specified product in storage
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'slug' => 'sometimes|required|string|max:255|unique:products,slug,'.$product->id,
            'shop_id' => 'sometimes|required|exists:shops,id',
            'category_id' => 'sometimes|required|exists:categories,id',
            'primary_image' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'is_active' => 'sometimes|required|boolean',
        ]);

        $product->update($validatedData);

        return response()->json($product);
    }

    // Remove the specified product from storage
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(['message' => 'Product deleted successfully']);
    }
}
