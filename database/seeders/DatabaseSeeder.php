<?php

namespace Database\Seeders;

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
			// AlumnoSeeder::class,
			// NotaSeeder::class,
			LineaExpedienteSeeder::class
		]);
    }
}
