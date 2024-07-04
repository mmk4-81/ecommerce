<?php

namespace App\Http\Controllers;

use App\Models\Following;
use Illuminate\Http\Request;

class FollowingController extends Controller
{
    // Display a listing of the followings
    public function index()
    {
        $followings = Following::with('follower', 'followingShop')->get();
        return response()->json($followings);
    }

    // Store a newly created following in storage
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'follower_id' => 'required|exists:users,id',
            'following_shop_id' => 'required|exists:shops,id',
            'following_date' => 'required|date',
        ]);

        $following = Following::create($validatedData);

        return response()->json($following, 201);
    }

    // Display the specified following
    public function show($id)
    {
        $following = Following::with('follower', 'followingShop')->findOrFail($id);
        return response()->json($following);
    }

    // Update the specified following in storage
    public function update(Request $request, $id)
    {
        $following = Following::findOrFail($id);

        $validatedData = $request->validate([
            'follower_id' => 'sometimes|required|exists:users,id',
            'following_shop_id' => 'sometimes|required|exists:shops,id',
            'following_date' => 'sometimes|required|date',
        ]);

        $following->update($validatedData);

        return response()->json($following);
    }

    // Remove the specified following from storage
    public function destroy($id)
    {
        $following = Following::findOrFail($id);
        $following->delete();

        return response()->json(['message' => 'Following deleted successfully']);
    }
}
