<?php

namespace Database\Seeders;

use App\Models\Alumno;
use App\Models\Expediente;
use App\Models\Usuario;
use App\Models\Modulo;
use App\Models\Curso;
use App\Models\Personal;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
		$this -> command -> info("Inciando seeder...");

		$this -> call([
			// UsuarioSeeder::class,
			// PersonalAlumnoSeeder::class,
			// CursoSeeder::class,
			// ModuloSeeder::class,
			LineaExpedienteSeeder::class
		]);
    }
}
