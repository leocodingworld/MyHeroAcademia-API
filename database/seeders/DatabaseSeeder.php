<?php

namespace Database\Seeders;

use App\Models\Personal;
use App\Models\Usuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // Usuario::factory(15) -> create();
		Personal::factory(5) -> create();
    }
}
