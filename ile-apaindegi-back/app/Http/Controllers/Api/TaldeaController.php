<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Taldea;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class TaldeaController extends Controller
{
    public function index(): JsonResponse
    {
        $taldeak = Taldea::all();
        return response()->json($taldeak, 200);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'izena' => 'required|string|max:255',
        ]);

        $taldea = Taldea::create($validated);
        return response()->json($taldea, 201);
    }

    public function show(Taldea $taldea): JsonResponse
    {
        return response()->json($taldea, 200);
    }

    public function update(Request $request, Taldea $taldea): JsonResponse
    {
        $validated = $request->validate([
            'izena' => 'sometimes|string|max:255',
        ]);

        $taldea->update($validated);
        return response()->json($taldea, 200);
    }

    public function destroy(Taldea $taldea): JsonResponse
    {
        $taldea->delete();
        return response()->json(null, 204);
    }
}
