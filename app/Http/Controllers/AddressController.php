<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    // Display a listing of the addresses
    public function index()
    {
        $addresses = Address::all();
        return response()->json($addresses);
    }

    // Store a newly created address in storage
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'province' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'address' => 'required|string|max:1000',
            'postal_code' => 'required|string|max:20',
        ]);

        $address = Address::create($validatedData);

        return response()->json($address, 201);
    }

    // Display the specified address
    public function show($id)
    {
        $address = Address::findOrFail($id);
        return response()->json($address);
    }

    // Update the specified address in storage
    public function update(Request $request, $id)
    {
        $address = Address::findOrFail($id);

        $validatedData = $request->validate([
            'user_id' => 'sometimes|required|exists:users,id',
            'province' => 'sometimes|required|string|max:255',
            'city' => 'sometimes|required|string|max:255',
            'title' => 'sometimes|required|string|max:255',
            'address' => 'sometimes|required|string|max:1000',
            'postal_code' => 'sometimes|required|string|max:20',
        ]);

        $address->update($validatedData);

        return response()->json($address);
    }

    // Remove the specified address from storage
    public function destroy($id)
    {
        $address = Address::findOrFail($id);
        $address->delete();

        return response()->json(['message' => 'Address deleted successfully']);
    }
}
