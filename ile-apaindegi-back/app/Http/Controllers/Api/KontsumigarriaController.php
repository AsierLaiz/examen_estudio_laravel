<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kontsumigarria;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class KontsumigarriaController extends Controller
{
    public function index(): JsonResponse
    {
        $kontsumigarriak = Kontsumigarria::with('kategoria')->get();
        return response()->json($kontsumigarriak, 200);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'izena' => 'required|string|max:255',
            'deskribapena' => 'nullable|string',
            'batch' => 'required|string|max:255',
            'marka' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'min_stock' => 'required|integer|min:0',
            'iraungitze_data' => 'required|date',
            'kategoriak_id' => 'required|exists:kategoriak,id',
        ]);

        $kontsumigarria = Kontsumigarria::create($validated);
        return response()->json($kontsumigarria, 201);
    }

    public function show(Kontsumigarria $kontsumigarria): JsonResponse
    {
        $kontsumigarria->load('kategoria', 'ikasleaKontsumigarriak');
        return response()->json($kontsumigarria, 200);
    }

    public function update(Request $request, Kontsumigarria $kontsumigarria): JsonResponse
    {
        $validated = $request->validate([
            'izena' => 'sometimes|string|max:255',
            'deskribapena' => 'nullable|string',
            'batch' => 'sometimes|string|max:255',
            'marka' => 'sometimes|string|max:255',
            'stock' => 'sometimes|integer|min:0',
            'min_stock' => 'sometimes|integer|min:0',
            'iraungitze_data' => 'sometimes|date',
            'kategoriak_id' => 'sometimes|exists:kategoriak,id',
        ]);

        $kontsumigarria->update($validated);
        return response()->json($kontsumigarria, 200);
    }

    public function destroy(Kontsumigarria $kontsumigarria): JsonResponse
    {
        $kontsumigarria->delete();
        return response()->json(null, 204);
    }

    public function getByKategoria($kategoria_id): JsonResponse
    {
        $kontsumigarriak = Kontsumigarria::where('kategoriak_id', $kategoria_id)->with('kategoria')->get();
        return response()->json($kontsumigarriak, 200);
    }

    public function getLowStock(): JsonResponse
    {
        $kontsumigarriak = Kontsumigarria::whereRaw('stock <= min_stock')->with('kategoria')->get();
        return response()->json($kontsumigarriak, 200);
    }

    public function getExpired(): JsonResponse
    {
        $kontsumigarriak = Kontsumigarria::where('iraungitze_data', '<', now())->with('kategoria')->get();
        return response()->json($kontsumigarriak, 200);
    }
}
