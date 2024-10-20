<?php

use App\Http\Controllers\loginController;
use App\Http\Controllers\requestController;
use App\Http\Controllers\userController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [loginController::class, 'login']);
Route::post('/register', [loginController::class, 'register']);
Route::middleware('auth:sanctum')->group(function () {
   Route::post('/logout', [loginController::class, 'logout']);
   Route::post('/crear-solicitud', [requestController::class, 'crearSolicitud']);
   Route::get('/solicitudes/{user_id}/{rol_id}', [requestController::class, 'buscarSolicitudes']);
   Route::get('/usuarios', [userController::class, 'buscarUsuarios']);
   Route::post('/crear-usuario', [userController::class, 'crearUsuario']);
});