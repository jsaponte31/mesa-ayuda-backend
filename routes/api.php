<?php

use App\Http\Controllers\loginController;
use App\Http\Controllers\requestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/login', [loginController::class, 'login']);
Route::post('/register', [loginController::class, 'register']);
Route::middleware('auth:sanctum')->group(function () {
   Route::post('/logout', [loginController::class, 'logout']);
   Route::get('/solicitudes/{user_id}/{rol_id}', [requestController::class, 'buscarSolicitudes']);//request del usuario,administrador de mesa de ayuda,tecnico
   Route::post('/crear-solicitud', [requestController::class, 'crearSolicitud']);//crear request
});