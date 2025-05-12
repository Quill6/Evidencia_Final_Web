<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PartidaController;
use App\Http\Controllers\PalabraController;

Route::post('registro', [AuthController::class, 'registro']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('user', function (Request $request) {
        return $request->user();
    });

    Route::apiResource('palabras', PalabraController::class);

    
    // Rutas del juego
    Route::apiResource('partidas', PartidaController::class)->only(['store', 'show']);
    Route::get('/partidas/{partida}/siguiente-palabra', [PartidaController::class, 'siguientePalabra']);
    Route::post('/partidas/{partida}/responder', [PartidaController::class, 'responder']);

});
