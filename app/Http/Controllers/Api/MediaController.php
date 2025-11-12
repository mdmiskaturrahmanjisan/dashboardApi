<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function index()
    {
        return Media::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'mediable_id' => 'required|integer',
            'mediable_type' => 'required|string',
            'collection_name' => 'nullable|string',
            'original_url' => 'required|string',
        ]);

        $media = Media::create($validated);
        return response()->json($media, 201);
    }

    public function show($id)
    {
        return Media::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $media = Media::findOrFail($id);
        $media->update($request->only(['collection_name', 'original_url']));
        return response()->json($media);
    }

    public function destroy($id)
    {
        Media::findOrFail($id)->delete();
        return response()->noContent();
    }
}
