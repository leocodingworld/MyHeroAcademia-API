<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Usuario>
 */
class UsuarioFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
			"email" => $this -> faker -> unique() -> email(),
			"password" => bcrypt("123abc."),
			"activo" => $this -> faker -> randomElement([true, false]),
			"nivel" => $this -> faker -> randomElement([1, 2, 3]),
        ];
    }
}
