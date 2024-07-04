<?php

namespace App\Http\Controllers;

use App\Models\ProductVariation;
use Illuminate\Http\Request;

class ProductVariationController extends Controller
{
    // Display a listing of the product variations
    public function index()
    {
        $productVariations = ProductVariation::with('attribute', 'product', 'orderItems')->get();
        return response()->json($productVariations);
    }

    // Store a newly created product variation in storage
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'value' => 'required|string|max:255',
            'price' => 'required|numeric',
            'quantity' => 'required|integer|min:0',
            'attribute_id' => 'required|exists:attributes,id',
            'product_id' => 'required|exists:products,id',
        ]);

        $productVariation = ProductVariation::create($validatedData);

        return response()->json($productVariation, 201);
    }

    // Display the specified product variation
    public function show($id)
    {
        $productVariation = ProductVariation::with('attribute', 'product', 'orderItems')->findOrFail($id);
        return response()->json($productVariation);
    }

    // Update the specified product variation in storage
    public function update(Request $request, $id)
    {
        $productVariation = ProductVariation::findOrFail($id);

        $validatedData = $request->validate([
            'value' => 'sometimes|required|string|max:255',
            'price' => 'sometimes|required|numeric',
            'quantity' => 'sometimes|required|integer|min:0',
            'attribute_id' => 'sometimes|required|exists:attributes,id',
            'product_id' => 'sometimes|required|exists:products,id',
        ]);

        $productVariation->update($validatedData);

        return response()->json($productVariation);
    }

    // Remove the specified product variation from storage
    public function destroy($id)
    {
        $productVariation = ProductVariation::findOrFail($id);
        $productVariation->delete();

        return response()->json(['message' => 'Product variation deleted successfully']);
    }
}
