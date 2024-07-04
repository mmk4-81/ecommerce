<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    // Display a listing of the shops
    public function index()
    {
        $shops = Shop::all();
        return response()->json($shops);
    }

    // Store a newly created shop in storage
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'shop_name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:shops,slug',
            'description' => 'nullable|string|max:1000',
            'is_active' => 'required|boolean',
        ]);

        $shop = Shop::create($validatedData);

        return response()->json($shop, 201);
    }

    // Display the specified shop
    public function show($id)
    {
        $shop = Shop::findOrFail($id);
        return response()->json($shop);
    }

    // Update the specified shop in storage
    public function update(Request $request, $id)
    {
        $shop = Shop::findOrFail($id);

        $validatedData = $request->validate([
            'user_id' => 'sometimes|required|exists:users,id',
            'shop_name' => 'sometimes|required|string|max:255',
            'slug' => 'sometimes|required|string|max:255|unique:shops,slug,'.$shop->id,
            'description' => 'nullable|string|max:1000',
            'is_active' => 'sometimes|required|boolean',
        ]);

        $shop->update($validatedData);

        return response()->json($shop);
    }

    // Remove the specified shop from storage
    public function destroy($id)
    {
        $shop = Shop::findOrFail($id);
        $shop->delete();

        return response()->json(['message' => 'Shop deleted successfully']);
    }
}
