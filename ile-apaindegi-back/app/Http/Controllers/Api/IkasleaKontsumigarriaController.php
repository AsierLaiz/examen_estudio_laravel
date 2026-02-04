<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\IkasleaKontsumigarria;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class IkasleaKontsumigarriaController extends Controller
{
    public function index(): JsonResponse
    {
        $ikasleaKontsumigarriak = IkasleaKontsumigarria::with('ikaslea', 'kontsumigarria')->get();
        return response()->json($ikasleaKontsumigarriak, 200);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'ikaslea_id' => 'required|exists:ikasleak,id',
            'kontsumigarria_id' => 'required|exists:kontsumigarriak,id',
            'erabilitako_kopurua' => 'required|integer|min:1',
            'erabiltzeko_data' => 'required|date_format:Y-m-d H:i:s',
        ]);

        $ikasleaKontsumigarria = IkasleaKontsumigarria::create($validated);
        return response()->json($ikasleaKontsumigarria, 201);
    }

    public function show(IkasleaKontsumigarria $ikasleaKontsumigarria): JsonResponse
    {
        $ikasleaKontsumigarria->load('ikaslea', 'kontsumigarria');
        return response()->json($ikasleaKontsumigarria, 200);
    }

    public function update(Request $request, IkasleaKontsumigarria $ikasleaKontsumigarria): JsonResponse
    {
        $validated = $request->validate([
            'ikaslea_id' => 'sometimes|exists:ikasleak,id',
            'kontsumigarria_id' => 'sometimes|exists:kontsumigarriak,id',
            'erabilitako_kopurua' => 'sometimes|integer|min:1',
            'erabiltzeko_data' => 'sometimes|date_format:Y-m-d H:i:s',
        ]);

        $ikasleaKontsumigarria->update($validated);
        return response()->json($ikasleaKontsumigarria, 200);
    }

    public function destroy(IkasleaKontsumigarria $ikasleaKontsumigarria): JsonResponse
    {
        $ikasleaKontsumigarria->delete();
        return response()->json(null, 204);
    }
}
