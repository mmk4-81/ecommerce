<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Display a listing of the orders
    public function index()
    {
        $orders = Order::with('user', 'orderItems')->get();
        return response()->json($orders);
    }

    // Store a newly created order in storage
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'payment_status' => 'required|string|max:255',
            'order_status' => 'required|string|max:255',
            'total_amount' => 'required|numeric',
            'description' => 'nullable|string|max:1000',
        ]);

        $order = Order::create($validatedData);

        return response()->json($order, 201);
    }

    // Display the specified order
    public function show($id)
    {
        $order = Order::with('user', 'orderItems')->findOrFail($id);
        return response()->json($order);
    }

    // Update the specified order in storage
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $validatedData = $request->validate([
            'user_id' => 'sometimes|required|exists:users,id',
            'payment_status' => 'sometimes|required|string|max:255',
            'order_status' => 'sometimes|required|string|max:255',
            'total_amount' => 'sometimes|required|numeric',
            'description' => 'nullable|string|max:1000',
        ]);

        $order->update($validatedData);

        return response()->json($order);
    }

    // Remove the specified order from storage
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return response()->json(['message' => 'Order deleted successfully']);
    }
}
