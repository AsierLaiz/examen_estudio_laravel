<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bezeroa;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class BezeroareController extends Controller
{
    public function index(): JsonResponse
    {
        $bezeroak = Bezeroa::all();
        return response()->json($bezeroak, 200);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'izena' => 'required|string|max:255',
            'abizenak' => 'required|string|max:255',
            'telefonoa' => 'required|string|max:20',
            'posta_elek' => 'required|email|max:255',
            'etxeko_bezeroa' => 'boolean',
        ]);

        $bezeroa = Bezeroa::create($validated);
        return response()->json($bezeroa, 201);
    }

    public function show(Bezeroa $bezeroa): JsonResponse
    {
        $bezeroa->load('hitzorduak');
        return response()->json($bezeroa, 200);
    }

    public function update(Request $request, Bezeroa $bezeroa): JsonResponse
    {
        $validated = $request->validate([
            'izena' => 'sometimes|string|max:255',
            'abizenak' => 'sometimes|string|max:255',
            'telefonoa' => 'sometimes|string|max:20',
            'posta_elek' => 'sometimes|email|max:255',
            'etxeko_bezeroa' => 'sometimes|boolean',
        ]);

        $bezeroa->update($validated);
        return response()->json($bezeroa, 200);
    }

    public function destroy(Bezeroa $bezeroa): JsonResponse
    {
        $bezeroa->delete();
        return response()->json(null, 204);
    }
}
