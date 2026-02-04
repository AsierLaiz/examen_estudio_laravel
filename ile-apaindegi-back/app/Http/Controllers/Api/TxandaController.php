<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Txanda;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class TxandaController extends Controller
{
    public function index(): JsonResponse
    {
        $txandak = Txanda::with('ikaslea')->get();
        return response()->json($txandak, 200);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'mota' => 'required|string|max:1',
            'data' => 'required|date',
            'ikaslea_id' => 'required|exists:ikasleak,id',
        ]);

        $txanda = Txanda::create($validated);
        return response()->json($txanda, 201);
    }

    public function show(Txanda $txanda): JsonResponse
    {
        $txanda->load('ikaslea');
        return response()->json($txanda, 200);
    }

    public function update(Request $request, Txanda $txanda): JsonResponse
    {
        $validated = $request->validate([
            'mota' => 'sometimes|string|max:1',
            'data' => 'sometimes|date',
            'ikaslea_id' => 'sometimes|exists:ikasleak,id',
        ]);

        $txanda->update($validated);
        return response()->json($txanda, 200);
    }

    public function destroy(Txanda $txanda): JsonResponse
    {
        $txanda->delete();
        return response()->json(null, 204);
    }
}
