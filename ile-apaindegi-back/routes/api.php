<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TaldeaController;
use App\Http\Controllers\Api\IkasleaController;
use App\Http\Controllers\Api\OrdutegiaController;
use App\Http\Controllers\Api\ErabiltzaileaController;
use App\Http\Controllers\Api\BezeroareController;
use App\Http\Controllers\Api\ZerbitzuaController;
use App\Http\Controllers\Api\HitzorduaController;
use App\Http\Controllers\Api\KategoriaController;
use App\Http\Controllers\Api\KontsumigarriaController;
use App\Http\Controllers\Api\EkipamenduaController;
use App\Http\Controllers\Api\TxandaController;
use App\Http\Controllers\Api\IkasleaEkipamenduaController;
use App\Http\Controllers\Api\IkasleaKontsumigarriaController;
use App\Http\Controllers\Api\HitzorduaZerbitzuaController;

// Rutas públicas de autenticación
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

// Rutas protegidas
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    
    Route::get('/auth/me', [AuthController::class, 'me']);
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::post('/auth/revoke-all-tokens', [AuthController::class, 'revokeAllTokens']);
    
    // Rutas de recursos protegidas
    Route::apiResource('taldeak', TaldeaController::class);
    Route::apiResource('ikasleak', IkasleaController::class);
    Route::apiResource('ordutegiak', OrdutegiaController::class);
    Route::apiResource('erabiltzaileak', ErabiltzaileaController::class);
    Route::apiResource('bezeroak', BezeroareController::class);
    Route::apiResource('zerbitzuak', ZerbitzuaController::class);
    Route::apiResource('kategoriak', KategoriaController::class);
    Route::apiResource('kontsumigarriak', KontsumigarriaController::class);
    Route::apiResource('ekipamenduak', EkipamenduaController::class);
    Route::apiResource('txandak', TxandaController::class);
    Route::apiResource('hitzorduak', HitzorduaController::class);
    Route::post('hitzorduak/{hitzordua}/attach-service', [HitzorduaController::class, 'attachService']);
    Route::post('hitzorduak/{hitzordua}/detach-service', [HitzorduaController::class, 'detachService']);
    Route::apiResource('ikasleak-ekipamenduak', IkasleaEkipamenduaController::class);
    Route::apiResource('ikasleak-kontsumigarriak', IkasleaKontsumigarriaController::class);
    Route::apiResource('hitzorduak-zerbitzuak', HitzorduaZerbitzuaController::class);
    
    Route::prefix('reports')->group(function () {
        Route::get('ikasleak-by-taldea/{taldea}', [IkasleaController::class, 'getByTaldea']);
        Route::get('hitzorduak-by-bezeroa/{bezeroa}', [HitzorduaController::class, 'getByBezeroa']);
        Route::get('kontsumigarriak-by-kategoria/{kategoria}', [KontsumigarriaController::class, 'getByKategoria']);
        Route::get('ekipamenduak-by-ikaslea/{ikaslea}', [EkipamenduaController::class, 'getByIkaslea']);
        Route::get('kontsumigarriak-stock-bajo', [KontsumigarriaController::class, 'getLowStock']);
        Route::get('kontsumigarriak-vencidos', [KontsumigarriaController::class, 'getExpired']);
    });
});
