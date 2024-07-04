<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    // Display a listing of the order items
    public function index()
    {
        $orderItems = OrderItem::with('order', 'product', 'productVariation')->get();
        return response()->json($orderItems);
    }

    // Store a newly created order item in storage
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'product_variation_id' => 'required|exists:product_variations,id',
            'count' => 'required|integer|min:1',
        ]);

        $orderItem = OrderItem::create($validatedData);

        return response()->json($orderItem, 201);
    }

    // Display the specified order item
    public function show($id)
    {
        $orderItem = OrderItem::with('order', 'product', 'productVariation')->findOrFail($id);
        return response()->json($orderItem);
    }

    // Update the specified order item in storage
    public function update(Request $request, $id)
    {
        $orderItem = OrderItem::findOrFail($id);

        $validatedData = $request->validate([
            'order_id' => 'sometimes|required|exists:orders,id',
            'product_id' => 'sometimes|required|exists:products,id',
            'product_variation_id' => 'sometimes|required|exists:product_variations,id',
            'count' => 'sometimes|required|integer|min:1',
        ]);

        $orderItem->update($validatedData);

        return response()->json($orderItem);
    }

    // Remove the specified order item from storage
    public function destroy($id)
    {
        $orderItem = OrderItem::findOrFail($id);
        $orderItem->delete();

        return response()->json(['message' => 'Order item deleted successfully']);
    }
}
