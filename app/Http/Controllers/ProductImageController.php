<?php

namespace App\Http\Controllers;

use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductImageController extends Controller
{
    // Display a listing of the product images
    public function index()
    {
        $productImages = ProductImage::with('product')->get();
        return response()->json($productImages);
    }

    // Store a newly created product image in storage
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'image' => 'required|string|max:255',
        ]);

        $productImage = ProductImage::create($validatedData);

        return response()->json($productImage, 201);
    }

    // Display the specified product image
    public function show($id)
    {
        $productImage = ProductImage::with('product')->findOrFail($id);
        return response()->json($productImage);
    }

    // Update the specified product image in storage
    public function update(Request $request, $id)
    {
        $productImage = ProductImage::findOrFail($id);

        $validatedData = $request->validate([
            'product_id' => 'sometimes|required|exists:products,id',
            'image' => 'sometimes|required|string|max:255',
        ]);

        $productImage->update($validatedData);

        return response()->json($productImage);
    }

    // Remove the specified product image from storage
    public function destroy($id)
    {
        $productImage = ProductImage::findOrFail($id);
        $productImage->delete();

        return response()->json(['message' => 'Product image deleted successfully']);
    }
}
