<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Erabiltzailea;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ErabiltzaileaController extends Controller
{
    public function index(): JsonResponse
    {
        $erabiltzaileak = Erabiltzailea::all();
        return response()->json($erabiltzaileak, 200);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'erabiltzaile_izena' => 'required|string|max:255|unique:erabiltzaileak',
            'posta_elek' => 'required|email|max:255|unique:erabiltzaileak',
            'rola' => 'required|string|max:1',
        ]);

        $erabiltzailea = Erabiltzailea::create($validated);
        return response()->json($erabiltzailea, 201);
    }

    public function show(Erabiltzailea $erabiltzailea): JsonResponse
    {
        return response()->json($erabiltzailea, 200);
    }

    public function update(Request $request, Erabiltzailea $erabiltzailea): JsonResponse
    {
        $validated = $request->validate([
            'erabiltzaile_izena' => 'sometimes|string|max:255|unique:erabiltzaileak,erabiltzaile_izena,' . $erabiltzailea->id,
            'posta_elek' => 'sometimes|email|max:255|unique:erabiltzaileak,posta_elek,' . $erabiltzailea->id,
            'rola' => 'sometimes|string|max:1',
        ]);

        $erabiltzailea->update($validated);
        return response()->json($erabiltzailea, 200);
    }

    public function destroy(Erabiltzailea $erabiltzailea): JsonResponse
    {
        $erabiltzailea->delete();
        return response()->json(null, 204);
    }
}
