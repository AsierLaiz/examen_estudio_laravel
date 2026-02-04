<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Hitzordua;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class HitzorduaController extends Controller
{
    public function index(): JsonResponse
    {
        $hitzorduak = Hitzordua::with('bezeroa', 'ikaslea', 'zerbitzuak')->get();
        return response()->json($hitzorduak, 200);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'iruzkina' => 'nullable|string',
            'hitzordua_data' => 'required|date',
            'hasiera_ordua' => 'required|date_format:H:i:s',
            'amaiera_ordua' => 'required|date_format:H:i:s',
            'bezeroa_id' => 'required|exists:bezeroak,id',
            'ikaslea_id' => 'nullable|exists:ikasleak,id',
        ]);

        $hitzordua = Hitzordua::create($validated);
        return response()->json($hitzordua, 201);
    }

    public function show(Hitzordua $hitzordua): JsonResponse
    {
        $hitzordua->load('bezeroa', 'ikaslea', 'zerbitzuak', 'hitzorduaZerbitzuak');
        return response()->json($hitzordua, 200);
    }

    public function update(Request $request, Hitzordua $hitzordua): JsonResponse
    {
        $validated = $request->validate([
            'iruzkina' => 'nullable|string',
            'hitzordua_data' => 'sometimes|date',
            'hasiera_ordua' => 'sometimes|date_format:H:i:s',
            'amaiera_ordua' => 'sometimes|date_format:H:i:s',
            'bezeroa_id' => 'sometimes|exists:bezeroak,id',
            'ikaslea_id' => 'nullable|sometimes|exists:ikasleak,id',
        ]);

        $hitzordua->update($validated);
        return response()->json($hitzordua, 200);
    }

    public function destroy(Hitzordua $hitzordua): JsonResponse
    {
        $hitzordua->delete();
        return response()->json(null, 204);
    }

    public function attachService(Request $request, Hitzordua $hitzordua): JsonResponse
    {
        $validated = $request->validate([
            'zerbitzua_id' => 'required|exists:zerbitzuak,id',
            'iruzkinak' => 'nullable|string',
        ]);

        $hitzordua->zerbitzuak()->attach($validated['zerbitzua_id'], [
            'iruzkinak' => $validated['iruzkinak'] ?? null,
        ]);

        return response()->json($hitzordua->load('zerbitzuak'), 200);
    }

    public function detachService(Request $request, Hitzordua $hitzordua): JsonResponse
    {
        $validated = $request->validate([
            'zerbitzua_id' => 'required|exists:zerbitzuak,id',
        ]);

        $hitzordua->zerbitzuak()->detach($validated['zerbitzua_id']);

        return response()->json($hitzordua->load('zerbitzuak'), 200);
    }

    public function getByBezeroa($bezeroa_id): JsonResponse
    {
        $hitzorduak = Hitzordua::where('bezeroa_id', $bezeroa_id)->with('bezeroa', 'ikaslea', 'zerbitzuak')->get();
        return response()->json($hitzorduak, 200);
    }
}
