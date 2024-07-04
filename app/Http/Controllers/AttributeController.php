<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    // Display a listing of the attributes
    public function index()
    {
        $attributes = Attribute::with('categories', 'products')->get();
        return response()->json($attributes);
    }

    // Store a newly created attribute in storage
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $attribute = Attribute::create($validatedData);

        return response()->json($attribute, 201);
    }

    // Display the specified attribute
    public function show($id)
    {
        $attribute = Attribute::with('categories', 'products')->findOrFail($id);
        return response()->json($attribute);
    }

    // Update the specified attribute in storage
    public function update(Request $request, $id)
    {
        $attribute = Attribute::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
        ]);

        $attribute->update($validatedData);

        return response()->json($attribute);
    }

    // Remove the specified attribute from storage
    public function destroy($id)
    {
        $attribute = Attribute::findOrFail($id);
        $attribute->delete();

        return response()->json(['message' => 'Attribute deleted successfully']);
    }
}
