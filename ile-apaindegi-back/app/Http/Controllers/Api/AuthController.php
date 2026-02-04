<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Erabiltzailea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        $validated = $request->validate([
            'erabiltzaile_izena' => 'required|string|max:255|unique:erabiltzaileak',
            'posta_elek' => 'required|email|max:255|unique:erabiltzaileak',
            'password' => 'required|string|min:8|confirmed',
            'rola' => 'required|string|max:1',
        ]);

        $erabiltzailea = Erabiltzailea::create([
            'erabiltzaile_izena' => $validated['erabiltzaile_izena'],
            'posta_elek' => $validated['posta_elek'],
            'password' => Hash::make($validated['password']),
            'rola' => $validated['rola'],
        ]);

        $token = $erabiltzailea->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Usuario registrado exitosamente',
            'user' => $erabiltzailea,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ], 201);
    }

 
    public function login(Request $request)
    {
        $request->validate([
            'posta_elek' => 'required|email',
            'password' => 'required',
        ]);

        $erabiltzailea = Erabiltzailea::where('posta_elek', $request->posta_elek)->first();

        if (!$erabiltzailea || !Hash::check($request->password, $erabiltzailea->password)) {
            throw ValidationException::withMessages([
                'posta_elek' => ['Las credenciales proporcionadas son incorrectas.'],
            ]);
        }

        $token = $erabiltzailea->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login exitoso',
            'user' => $erabiltzailea,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    /**
     * Obtener el usuario autenticado
     */
    public function me(Request $request)
    {
        return response()->json([
            'user' => $request->user(),
        ]);
    }

    /**
     * Logout - revocar token
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Sesión cerrada exitosamente',
        ]);
    }

    /**
     * Revocar todos los tokens del usuario
     */
    public function revokeAllTokens(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Todos los tokens han sido revocados',
        ]);
    }
}
