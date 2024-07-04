<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Display a listing of the categories
    public function index()
    {
        $categories = Category::with('children', 'parent', 'products', 'attributes')->get();
        return response()->json($categories);
    }

    // Store a newly created category in storage
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'parent_id' => 'nullable|exists:categories,id',
            'category_name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug',
            'description' => 'nullable|string|max:1000',
            'icon' => 'nullable|string|max:255',
            'is_active' => 'required|boolean',
        ]);

        $category = Category::create($validatedData);

        return response()->json($category, 201);
    }

    // Display the specified category
    public function show($id)
    {
        $category = Category::with('children', 'parent', 'products', 'attributes')->findOrFail($id);
        return response()->json($category);
    }

    // Update the specified category in storage
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $validatedData = $request->validate([
            'parent_id' => 'nullable|exists:categories,id',
            'category_name' => 'sometimes|required|string|max:255',
            'slug' => 'sometimes|required|string|max:255|unique:categories,slug,'.$category->id,
            'description' => 'nullable|string|max:1000',
            'icon' => 'nullable|string|max:255',
            'is_active' => 'sometimes|required|boolean',
        ]);

        $category->update($validatedData);

        return response()->json($category);
    }

    // Remove the specified category from storage
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json(['message' => 'Category deleted successfully']);
    }
}
