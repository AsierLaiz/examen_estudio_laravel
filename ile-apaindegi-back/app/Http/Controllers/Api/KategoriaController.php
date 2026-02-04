<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kategoria;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class KategoriaController extends Controller
{
    public function index(): JsonResponse
    {
        $kategoriak = Kategoria::all();
        return response()->json($kategoriak, 200);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'izena' => 'required|string|max:255',
        ]);

        $kategoria = Kategoria::create($validated);
        return response()->json($kategoria, 201);
    }

    public function show(Kategoria $kategoria): JsonResponse
    {
        $kategoria->load('kontsumigarriak');
        return response()->json($kategoria, 200);
    }

    public function update(Request $request, Kategoria $kategoria): JsonResponse
    {
        $validated = $request->validate([
            'izena' => 'sometimes|string|max:255',
        ]);

        $kategoria->update($validated);
        return response()->json($kategoria, 200);
    }

    public function destroy(Kategoria $kategoria): JsonResponse
    {
        $kategoria->delete();
        return response()->json(null, 204);
    }
}
