<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\loginController;
use App\Http\Controllers\requestController;
use App\Http\Controllers\userController;
use Illuminate\Http\Request;

Route::middleware([\Illuminate\Session\Middleware\StartSession::class])->group(function () {
   Route::post('/login', [LoginController::class, 'login']);
});
Route::post('/register', [loginController::class, 'register']);
Route::middleware('auth:api')->group(function () {
   Route::get('/session-data', [userController::class, 'getUserSessionData']);
   Route::post('/logout', [loginController::class, 'logout']);
   Route::post('/crear-solicitud', [requestController::class, 'crearSolicitud']);
   Route::post('/asignar-solicitud', [requestController::class, 'asignarSolicitud']);
   Route::post('/procesar-solicitud', [requestController::class, 'procesarSolicitud']);
   Route::post('/finalizar-solicitud', [requestController::class, 'finalizarSolicitud']);
   Route::get('/solicitudes/{user_id}/{rol_id}', [requestController::class, 'buscarSolicitudes']);
   Route::get('/usuarios', [userController::class, 'buscarUsuarios']);
   Route::post('/crear-usuario', [userController::class, 'crearUsuario']);
   Route::post('/actualizar-usuario', [userController::class, 'actualizarUsuario']);
});