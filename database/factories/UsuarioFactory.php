<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
            "nombre" => $this -> faker -> firstName(),
			"apellidos" => $this -> faker -> lastName(),
			"email" => $this -> faker -> email(),
			"direccion" => $this -> faker -> streetAddress(),
			"telefono" => Str::replace("-", "", $this -> faker -> phoneNumber()),
			"password" => bcrypt("123abc."),
			"tipo" => $this -> faker -> randomElement([1, 2, 3]),
        ];
    }
}
