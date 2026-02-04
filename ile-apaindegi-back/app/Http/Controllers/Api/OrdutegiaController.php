<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ordutegia;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class OrdutegiaController extends Controller
{
    public function index(): JsonResponse
    {
        $ordutegiak = Ordutegia::with('taldea')->get();
        return response()->json($ordutegiak, 200);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'eguna' => 'required|integer|between:0,6',
            'hasiera_data' => 'required|date',
            'amaiera_data' => 'required|date|after_or_equal:hasiera_data',
            'hasiera_ordua' => 'required|date_format:H:i:s',
            'amaiera_ordua' => 'required|date_format:H:i:s',
            'taldea_id' => 'required|exists:taldeak,id',
        ]);

        $ordutegia = Ordutegia::create($validated);
        return response()->json($ordutegia, 201);
    }

    public function show(Ordutegia $ordutegia): JsonResponse
    {
        $ordutegia->load('taldea');
        return response()->json($ordutegia, 200);
    }

    public function update(Request $request, Ordutegia $ordutegia): JsonResponse
    {
        $validated = $request->validate([
            'eguna' => 'sometimes|integer|between:0,6',
            'hasiera_data' => 'sometimes|date',
            'amaiera_data' => 'sometimes|date|after_or_equal:hasiera_data',
            'hasiera_ordua' => 'sometimes|date_format:H:i:s',
            'amaiera_ordua' => 'sometimes|date_format:H:i:s',
            'taldea_id' => 'sometimes|exists:taldeak,id',
        ]);

        $ordutegia->update($validated);
        return response()->json($ordutegia, 200);
    }

    public function destroy(Ordutegia $ordutegia): JsonResponse
    {
        $ordutegia->delete();
        return response()->json(null, 204);
    }
}
