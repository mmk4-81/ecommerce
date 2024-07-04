<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    // Display a listing of the users
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    // Store a newly created user in storage
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'phone' => 'nullable|string|max:20',
            'avatar' => 'nullable|string|max:255',
            'credit' => 'nullable|numeric',
            'role' => 'nullable|string|max:50',
        ]);

        $user = User::create([
            'fullname' => $validatedData['fullname'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'phone' => $validatedData['phone'] ?? null,
            'avatar' => $validatedData['avatar'] ?? null,
            'credit' => $validatedData['credit'] ?? 0,
            'role' => $validatedData['role'] ?? 'user',
        ]);

        return response()->json($user, 201);
    }

    // Display the specified user
    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    // Update the specified user in storage
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'fullname' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:users,email,'.$user->id,
            'password' => 'sometimes|required|string|min:8',
            'phone' => 'nullable|string|max:20',
            'avatar' => 'nullable|string|max:255',
            'credit' => 'nullable|numeric',
            'role' => 'nullable|string|max:50',
        ]);

        if (isset($validatedData['password'])) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        }

        $user->update($validatedData);

        return response()->json($user);
    }

    // Remove the specified user from storage
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }
}
