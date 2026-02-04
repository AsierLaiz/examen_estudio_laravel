<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ikaslea;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class IkasleaController extends Controller
{
    public function index(): JsonResponse
    {
        $ikasleak = Ikaslea::with('taldea')->get();
        return response()->json($ikasleak, 200);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'izena' => 'required|string|max:255',
            'abizenak' => 'required|string|max:255',
            'taldea_id' => 'required|exists:taldeak,id',
        ]);

        $ikaslea = Ikaslea::create($validated);
        return response()->json($ikaslea, 201);
    }

    public function show(Ikaslea $ikaslea): JsonResponse
    {
        $ikaslea->load('taldea', 'txandak', 'ikasleaEkipamenduak', 'hitzorduak', 'ikasleaKontsumigarriak');
        return response()->json($ikaslea, 200);
    }

    public function update(Request $request, Ikaslea $ikaslea): JsonResponse
    {
        $validated = $request->validate([
            'izena' => 'sometimes|string|max:255',
            'abizenak' => 'sometimes|string|max:255',
            'taldea_id' => 'sometimes|exists:taldeak,id',
        ]);

        $ikaslea->update($validated);
        return response()->json($ikaslea, 200);
    }

    public function destroy(Ikaslea $ikaslea): JsonResponse
    {
        $ikaslea->delete();
        return response()->json(null, 204);
    }

    public function getByTaldea($taldea_id): JsonResponse
    {
        $ikasleak = Ikaslea::where('taldea_id', $taldea_id)->with('taldea')->get();
        return response()->json($ikasleak, 200);
    }
}
