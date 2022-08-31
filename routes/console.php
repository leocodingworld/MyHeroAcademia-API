<?php

use App\Models\Alumno;
use App\Models\Expediente;
use App\Models\Usuario;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

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
	$alumnos = Alumno::select("id") -> get();
	$i = 1;

	foreach($alumnos as $alumno) {
		Expediente::insert([
			"numero" => $i,
			"alumno" => $alumno -> id
		]);

		$i++;

		$this -> info("Expediente { $i, {$alumno -> id} }");
	}
});

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
