<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        return Service::with(['media', 'user', 'category'])->get();

    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'duration' => 'required|string',
            'duration_unit' => 'required|string',
            'required_servicemen' => 'required|integer|min:1',
            'discount' => 'nullable|integer|min:0',
            'price' => 'required|numeric|min:0',
            'service_rate' => 'required|numeric|min:0',
            'type' => 'required|string',
            'category_id' => 'nullable|integer|exists:categories,id',
            'status' => 'boolean',
            'user_id' => 'nullable|integer',
        ]);

        $service = Service::create($validated);
        return response()->json($service->load(['media', 'user']), 201);
    }

    public function show($id)
    {
        return Service::with(['media', 'user'])->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        $service->update($request->all());
        return response()->json($service->load(['media', 'user']));
    }

    public function destroy($id)
    {
        Service::findOrFail($id)->delete();
        return response()->noContent();
    }
}
