<?php

use App\Models\Usuario;
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

Route::get("/test", function(Request $request) {
	return Usuario::create([
		"nombre" => "Paco",
		"apellidos" => "Perez",
		"direccion" => "Avda Falsa 1",
		"telefono" => "123456789",
		"password" => "147852369",
		"activo" => true,
		"tipo" => 1
	]);
});
