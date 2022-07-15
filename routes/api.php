<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsuarioController;
use App\Models\Usuario;

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

Route::get("/test", function() {
	return Usuario::where("nivel", 1) -> paginate(40);
});

Route::controller(AuthController::class) -> group(function() {
	Route::post("/login", "login"); // OK
	Route::post("/logout", "logout");
});

Route::controller(UsuarioController::class) -> group(function() {
	Route::get("/datos/{usuario}", "getUsuarioData");
	Route::get("/usuarios", "getUsuarios");

	Route::post("/nuevo", "nuevoUsuario");

	Route::put("/editar", "editarUsuario");
	Route::put("/activar", "activarUsuario");
	Route::put("/desactivar", "desactivarUsuario");
});

Route::middleware("auth:sanctum") -> group(function() {

});
