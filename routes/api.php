<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

/**
 * Rutas de autenficación usando Tokens
 */
Route::controller(AuthController::class) -> group(function() {
	Route::post("/login", "login");
	Route::post("/logout", "logout");
});

Route::get("/test", [UsuarioController::class, "getUsuarios"]);

Route::middleware("auth:sanctum") -> group(function() {
	Route::controller(UsuarioController::class) -> group(function() {

	});
});
