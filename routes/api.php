<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\ExpedienteController;
use App\Http\Controllers\ModuloController;

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
	return "OK";
})-> middleware("auth:sanctum");

Route::controller(AuthController::class) -> group(function() {
	Route::post("/login", "login");
	Route::post("/logout", "logout");
});

Route::prefix("/usuarios") -> group(function() {
	Route::controller(UsuarioController::class) -> group(function() {
		Route::get("/datos/{usuario}", "getUsuarioData");
		Route::get("/", "getUsuarios");
		Route::get("/email/{email}", "checkEmail");
		Route::get("/dni/{dni}", "checkDni");

		Route::post("/nuevo", "createUsuario");

		Route::put("/editar", "editarUsuario");
		Route::put("/activar", "activarUsuario");
		Route::put("/desactivar", "desactivarUsuario");
	});
});

Route::prefix("/alumnos") -> group(function() {
	Route::controller(AlumnoController::class) -> group(function() {
		Route::get("/", "getAlumnos");
		Route::get("/modulo/{modulo}", "getAlumnosPorModulo");
	});
});

Route::prefix("/modulos") -> group(function() {
	Route::controller(ModuloController::class) -> group(function() {
		Route::get("/", "getModulos");
		Route::get("/{profesor}", "getModulosPorProfesor");

	});
});

Route::prefix("/expedientes") -> group(function() {
	Route::controller(ExpedienteController::class) -> group(function() {
		Route::get("/alumno/{alumno}", "getLineasExpediente");
	});
});

// Route::middleware("auth:sanctum") -> group(function() {
// 	Route::prefix("/usuarios") -> group(function() {
// 		Route::controller(UsuarioController::class) -> group(function() {
// 			Route::get("/datos/{usuario}", "getUsuarioData");
// 			Route::get("/", "getUsuarios");

// 			Route::post("/nuevo", "nuevoUsuario");

// 			Route::put("/editar", "editarUsuario");
// 			Route::put("/activar", "activarUsuario");
// 			Route::put("/desactivar", "desactivarUsuario");
// 		});
// 	});

// 	Route::prefix("/alumnos") -> group(function() {
// 		Route::controller(AlumnoController::class) -> group(function() {
// 			Route::get("/", "getAlumnos");
// 			Route::get("/modulo/{modulo}", "getAlumnosPorModulo");
// 		});
// 	});

// 	Route::prefix("/modulos") -> group(function() {
// 		Route::controller(ModuloController::class) -> group(function() {
// 			Route::get("/", "getModulos");
// 			Route::get("/{profesor}", "getModulosPorProfesor");
// 		});
// 	});
// });
