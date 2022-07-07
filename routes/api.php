<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsuarioController;
use App\Models\Usuario;
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

Route::get("/datos/{usuario}", function($usuario) {
	return Usuario::where("idusuario", $usuario) -> first(); // OK
});

Route::get("/usuarios", function() {
	return Usuario::all();
});

Route::controller(AuthController::class) -> group(function() {
	Route::post("/login", "login"); // OK
	Route::post("/logout", "logout");
});

Route::middleware("auth:sanctum") -> group(function() {

	Route::controller(UsuarioController::class) -> group(function() {

	});


});
