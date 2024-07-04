<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    // Display a listing of the banners
    public function index()
    {
        $banners = Banner::all();
        return response()->json($banners);
    }

    // Store a newly created banner in storage
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'image' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'priority' => 'required|integer',
            'is_active' => 'required|boolean',
            'type' => 'required|string|in:' . implode(',', Banner::TYPES),
            'button_text' => 'nullable|string|max:255',
            'button_link' => 'nullable|string|max:255',
            'button_icon' => 'nullable|string|max:255',
        ]);

        $banner = Banner::create($validatedData);

        return response()->json($banner, 201);
    }

    // Display the specified banner
    public function show($id)
    {
        $banner = Banner::findOrFail($id);
        return response()->json($banner);
    }

    // Update the specified banner in storage
    public function update(Request $request, $id)
    {
        $banner = Banner::findOrFail($id);

        $validatedData = $request->validate([
            'image' => 'sometimes|required|string|max:255',
            'title' => 'sometimes|required|string|max:255',
            'priority' => 'sometimes|required|integer',
            'is_active' => 'sometimes|required|boolean',
            'type' => 'sometimes|required|string|in:' . implode(',', Banner::TYPES),
            'button_text' => 'nullable|string|max:255',
            'button_link' => 'nullable|string|max:255',
            'button_icon' => 'nullable|string|max:255',
        ]);

        $banner->update($validatedData);

        return response()->json($banner);
    }

    // Remove the specified banner from storage
    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);
        $banner->delete();

        return response()->json(['message' => 'Banner deleted successfully']);
    }
}
