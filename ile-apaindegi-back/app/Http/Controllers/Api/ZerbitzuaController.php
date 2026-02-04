<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Zerbitzua;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ZerbitzuaController extends Controller
{
    public function index(): JsonResponse
    {
        $zerbitzuak = Zerbitzua::all();
        return response()->json($zerbitzuak, 200);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'izena' => 'required|string|max:255',
            'prezioa' => 'required|numeric|min:0',
            'etxeko_prezioa' => 'required|numeric|min:0',
            'iraunaldia' => 'required|integer|min:0',
        ]);

        $zerbitzua = Zerbitzua::create($validated);
        return response()->json($zerbitzua, 201);
    }

    public function show(Zerbitzua $zerbitzua): JsonResponse
    {
        $zerbitzua->load('hitzorduak', 'hitzorduaZerbitzuak');
        return response()->json($zerbitzua, 200);
    }

    public function update(Request $request, Zerbitzua $zerbitzua): JsonResponse
    {
        $validated = $request->validate([
            'izena' => 'sometimes|string|max:255',
            'prezioa' => 'sometimes|numeric|min:0',
            'etxeko_prezioa' => 'sometimes|numeric|min:0',
            'iraunaldia' => 'sometimes|integer|min:0',
        ]);

        $zerbitzua->update($validated);
        return response()->json($zerbitzua, 200);
    }

    public function destroy(Zerbitzua $zerbitzua): JsonResponse
    {
        $zerbitzua->delete();
        return response()->json(null, 204);
    }
}
