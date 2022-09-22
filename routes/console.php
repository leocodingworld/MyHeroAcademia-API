<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Inspiring;
use App\Models\Usuario;
use App\Models\Curso;
use App\Models\LineaExpediente;
use App\Models\Modulo;
use Illuminate\Support\Collection;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command("test", function() {
	// saco las notas del alumno
	$na = Usuario::find(1) -> alumno -> notas;

	// Me quedo solo con el campo del curso y los valores únicos
	$cursosIds = $na -> unique("curso") -> values() -> pluck("curso");

	// si salen más de un registro, me quedo normal.
	// Si solo hay uno solo me quedo con uno, recupero el valor
	$cursosIds = $cursosIds -> count() == 1
		? $cursosIds -> first()
		: $cursosIds;

	$curso = Curso::find($cursosIds);

	$modulos = $curso -> modulos;

	$notas = $modulos -> map(function($m) use ($na) {
		return new Collection([
			"modulo" => $m -> nombre,
			"notas" => $na -> where("modulo", $m -> id) -> makeHidden(["alumno", "curso", "modulo"]) -> flatten()
		]);
	});

	$this -> info(json_encode($notas, JSON_PRETTY_PRINT));

	// $cnotas = [
	// 	"curso" => "{$curso -> nivel} {$curso -> nombre}",
	// 	"notas" => $notas
	// ];

	// $fnotas = [
	// 	"curso" => "{$curso -> nivel} {$curso -> nombre}",
	// 	"modulos" => []
	// ];

	// $this -> info(json_encode($cnotas,JSON_PRETTY_PRINT));
});

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
