<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::with(['media', 'subCategories.media'])->whereNull('parent_id')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'parent_id' => 'nullable|integer|exists:categories,id',
        ]);

        $category = Category::create($validated);

        return response()->json($category->load(['media', 'subCategories.media']), 201);
    }

    public function show($id)
    {
        return Category::with(['media', 'subCategories.media'])->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->update($request->only(['title', 'parent_id']));

        return response()->json($category->load(['media', 'subCategories.media']));
    }

    public function destroy($id)
    {
        Category::findOrFail($id)->delete();
        return response()->noContent();
    }
}
