<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HitzorduaZerbitzua;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class HitzorduaZerbitzuaController extends Controller
{
    public function index(): JsonResponse
    {
        $hitzorduaZerbitzuak = HitzorduaZerbitzua::with('hitzordua', 'zerbitzua')->get();
        return response()->json($hitzorduaZerbitzuak, 200);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'iruzkinak' => 'nullable|string',
            'hitzordua_id' => 'required|exists:hitzorduak,id',
            'zerbitzua_id' => 'required|exists:zerbitzuak,id',
        ]);

        $hitzorduaZerbitzua = HitzorduaZerbitzua::create($validated);
        return response()->json($hitzorduaZerbitzua, 201);
    }

    public function show(HitzorduaZerbitzua $hitzorduaZerbitzua): JsonResponse
    {
        $hitzorduaZerbitzua->load('hitzordua', 'zerbitzua');
        return response()->json($hitzorduaZerbitzua, 200);
    }

    public function update(Request $request, HitzorduaZerbitzua $hitzorduaZerbitzua): JsonResponse
    {
        $validated = $request->validate([
            'iruzkinak' => 'nullable|string',
            'hitzordua_id' => 'sometimes|exists:hitzorduak,id',
            'zerbitzua_id' => 'sometimes|exists:zerbitzuak,id',
        ]);

        $hitzorduaZerbitzua->update($validated);
        return response()->json($hitzorduaZerbitzua, 200);
    }

    public function destroy(HitzorduaZerbitzua $hitzorduaZerbitzua): JsonResponse
    {
        $hitzorduaZerbitzua->delete();
        return response()->json(null, 204);
    }
}
