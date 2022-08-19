<?php

namespace Database\Seeders;

use App\Models\Usuario;
use App\Models\Modulo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {


		Usuario::factory(25) -> create();
		// $modulos1 = Modulo::where("curso", 1) -> get();
		// $modulos2 = Modulo::where("curso", 5) -> get();
		// $alumnos = Usuario::where("nivel", 1) -> paginate(10);

		// foreach($modulos1 as $m) {
		// 	for($i = 0; $i < 19; $i++) {
		// 		DB::table("alummodul") -> insert([
		// 			"anho" => "2022-09-01",
		// 			"curso" => $m -> curso,
		// 			"modulo" => $m -> id,
		// 			"alumno" => $alumnos[$i] -> id
		// 		]);
		// 	}
		// }

		// foreach($modulos2 as $m) {

		// 	for($i = 20; $i < $alumnos -> count(); $i++) {
		// 		DB::table("alummodul") -> insert([
		// 			"anho" => "2022-09-01",
		// 			"curso" => $m -> curso,
		// 			"modulo" => $m -> id,
		// 			"alumno" => $alumnos[$i] -> id
		// 		]);
		// 	}
		// }
    }
}
