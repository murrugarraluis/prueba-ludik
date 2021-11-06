<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/usuarios-partidas/{acepto}',[\App\Http\Controllers\UsuariosController::class,'getUsuariosPartidas']);
Route::get('/usuarios-porcentaje/{fecha1}/{fecha2}/{letra}',[\App\Http\Controllers\UsuariosController::class,'getUsuariosPorcentaje']);
Route::get('/usuarios-mas-ganadores/{disfraz}',[\App\Http\Controllers\UsuariosController::class,'getUsuariosMasGanadores']);
Route::get('/usuario-tiempo-promedio/{id}',[\App\Http\Controllers\UsuariosController::class,'getUsuarioTiempoPromedio']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
