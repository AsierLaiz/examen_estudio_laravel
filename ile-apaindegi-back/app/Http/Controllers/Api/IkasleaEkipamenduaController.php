<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\IkasleaEkipamendua;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class IkasleaEkipamenduaController extends Controller
{
    public function index(): JsonResponse
    {
        $ikasleaEkipamenduak = IkasleaEkipamendua::with('ikaslea', 'ekipamendua')->get();
        return response()->json($ikasleaEkipamenduak, 200);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'ikaslea_id' => 'required|exists:ikasleak,id',
            'ekipamendua_id' => 'required|exists:ekipamenduak,id',
            'hasiera_data' => 'required|date_format:Y-m-d H:i:s',
            'amaiera_data' => 'required|date_format:Y-m-d H:i:s|after_or_equal:hasiera_data',
        ]);

        $ikasleaEkipamendua = IkasleaEkipamendua::create($validated);
        return response()->json($ikasleaEkipamendua, 201);
    }

    public function show(IkasleaEkipamendua $ikasleaEkipamendua): JsonResponse
    {
        $ikasleaEkipamendua->load('ikaslea', 'ekipamendua');
        return response()->json($ikasleaEkipamendua, 200);
    }

    public function update(Request $request, IkasleaEkipamendua $ikasleaEkipamendua): JsonResponse
    {
        $validated = $request->validate([
            'ikaslea_id' => 'sometimes|exists:ikasleak,id',
            'ekipamendua_id' => 'sometimes|exists:ekipamenduak,id',
            'hasiera_data' => 'sometimes|date_format:Y-m-d H:i:s',
            'amaiera_data' => 'sometimes|date_format:Y-m-d H:i:s|after_or_equal:hasiera_data',
        ]);

        $ikasleaEkipamendua->update($validated);
        return response()->json($ikasleaEkipamendua, 200);
    }

    public function destroy(IkasleaEkipamendua $ikasleaEkipamendua): JsonResponse
    {
        $ikasleaEkipamendua->delete();
        return response()->json(null, 204);
    }
}
