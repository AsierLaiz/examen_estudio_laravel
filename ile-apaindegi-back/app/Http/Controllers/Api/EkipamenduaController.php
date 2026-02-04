<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ekipamendua;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class EkipamenduaController extends Controller
{
    public function index(): JsonResponse
    {
        $ekipamenduak = Ekipamendua::all();
        return response()->json($ekipamenduak, 200);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'etiketa' => 'required|string|max:255|unique:ekipamenduak',
            'izena' => 'required|string|max:255',
            'deskribapena' => 'nullable|string',
            'marka' => 'required|string|max:255',
        ]);

        $ekipamendua = Ekipamendua::create($validated);
        return response()->json($ekipamendua, 201);
    }

    public function show(Ekipamendua $ekipamendua): JsonResponse
    {
        $ekipamendua->load('ikasleaEkipamenduak');
        return response()->json($ekipamendua, 200);
    }

    public function update(Request $request, Ekipamendua $ekipamendua): JsonResponse
    {
        $validated = $request->validate([
            'etiketa' => 'sometimes|string|max:255|unique:ekipamenduak,etiketa,' . $ekipamendua->id,
            'izena' => 'sometimes|string|max:255',
            'deskribapena' => 'nullable|string',
            'marka' => 'sometimes|string|max:255',
        ]);

        $ekipamendua->update($validated);
        return response()->json($ekipamendua, 200);
    }

    public function destroy(Ekipamendua $ekipamendua): JsonResponse
    {
        $ekipamendua->delete();
        return response()->json(null, 204);
    }

    public function getByIkaslea($ikaslea_id): JsonResponse
    {
        $ekipamenduak = Ekipamendua::whereHas('ikasleaEkipamenduak', function ($query) use ($ikaslea_id) {
            $query->where('ikaslea_id', $ikaslea_id);
        })->with('ikasleaEkipamenduak')->get();
        return response()->json($ekipamenduak, 200);
    }
}
