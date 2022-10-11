<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\ExpedienteController;
use App\Http\Controllers\ModuloController;
use App\Http\Controllers\NotaController;
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
Route::controller(AuthController::class) -> group(function() {
	Route::post("/login", "login");
	Route::post("/logout", "logout");
});

Route::prefix("/usuarios") -> group(function() {
	Route::controller(UsuarioController::class) -> group(function() {
		Route::get("/", "getUsuarios");
		Route::get("/personal", "getPersonal");
		Route::get("/datos/{usuario}", "getUsuarioData");
		Route::get("/email/{email}", "checkEmail");
		Route::get("/dni/{dni}", "checkDni");

		Route::post("/nuevo", "createUsuario");

		Route::put("/editar/{id}", "editarUsuario");
		Route::put("/activar", "activarUsuario");
		Route::put("/desactivar", "desactivarUsuario");
	});
});

Route::prefix("/alumnos") -> group(function() {
	Route::controller(AlumnoController::class) -> group(function() {
		Route::get("/", "getAlumnos");
		Route::get("/{alumno}", "getAlumno");
		Route::get("/modulo/{modulo}", "getAlumnosPorModulo");

		Route::post("matricular/{curso}", "matricularAlumno");
	});
});

Route::prefix("/modulos") -> group(function() {
	Route::controller(ModuloController::class) -> group(function() {
		Route::get("/", "getModulos");
		Route::get("/{profesor}", "getModulosPorProfesor");
		Route::get("/alumnos/{modulo}", "getAlumnosPorModulo");
	});
});

Route::prefix("/notas") -> group(function() {
	Route::controller(NotaController::class) -> group(function() {
		Route::get("/alumno/{alumno}/", "getNotas");
		Route::get("/alumno/{alumno}/modulo/{modulo}", "getNotas");
	});
});

Route::prefix("/expedientes") -> group(function() {
	Route::controller(ExpedienteController::class) -> group(function() {
		Route::get("/alumno/{alumno}", "getLineasExpediente");
		// Route::get("/alumno/{alumno}/modulo/{modulo}", "getLineasExpediente");

		Route::post("/linea/nueva", "nuevaLinea");

		// Route::put("/linea/{linea}", "editarLinea");
	});
});

// Route::middleware("auth:sanctum") -> group(function() {
// 	Route::prefix("/usuarios") -> group(function() {
// 		Route::controller(UsuarioController::class) -> group(function() {
// 			Route::get("/", "getUsuarios");
// 			Route::get("/personal", "getPersonal");
// 			Route::get("/datos/{usuario}", "getUsuarioData");
// 			Route::get("/email/{email}", "checkEmail");
// 			Route::get("/dni/{dni}", "checkDni");

// 			Route::post("/nuevo", "createUsuario");

// 			Route::put("/editar/{id}", "editarUsuario");
// 			Route::put("/activar", "activarUsuario");
// 			Route::put("/desactivar", "desactivarUsuario");
// 		});
// 	});

// 	Route::prefix("/alumnos") -> group(function() {
// 		Route::controller(AlumnoController::class) -> group(function() {
// 			Route::get("/", "getAlumnos");
// 			Route::get("/modulo/{modulo}", "getAlumnosPorModulo");

// 			Route::post("matricular/{curso}", "matricularAlumno");
// 		});
// 	});

// 	Route::prefix("/modulos") -> group(function() {
// 		Route::controller(ModuloController::class) -> group(function() {
// 			Route::get("/", "getModulos");
// 			Route::get("/{profesor}", "getModulosPorProfesor");
// 			Route::get("/alumnos/{modulo}", "getAlumnosPorModulo");
// 		});
// 	});

// 	Route::prefix("/expedientes") -> group(function() {
// 		Route::controller(ExpedienteController::class) -> group(function() {
// 			Route::get("/alumno/{alumno}", "getLineasExpediente");
// 			Route::get("/alumno/{alumno}/modulo/{modulo}", "getLineasExpediente");

// 			Route::post("/linea/nueva", "nuevaLinea");

// 			Route::put("/linea/{linea}", "editarLinea");
// 		});
// 	});
// });
