<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Inspiring;
use App\Models\Usuario;
use App\Models\Curso;
use App\Models\LineaExpediente;
use App\Models\Modulo;

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
	$na = Usuario::find(1) -> alumno -> notas;

	$cursosIds = $na -> unique("curso") -> values() -> pluck("curso");
	$curso = Curso::find($cursosIds);

	$this -> info(json_encode($curso, JSON_PRETTY_PRINT));


	// $notas = $na -> map(function($n) {
	// 	return collect([
	// 		"referencia" => $n -> referencia,
	// 		"periodo" => $n -> periodo,
	// 		"calificacion" => $n -> calificacion,
	// 		"observaciones" => $n -> observaciones,
	// 	]);
	// });

	// $cnotas = [
	// 	"curso" => "{$curso -> nivel} {$curso -> nombre}",
	// 	"notas" => $notas
	// ];

	// $this -> info(json_encode($cnotas,JSON_PRETTY_PRINT));
});

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
