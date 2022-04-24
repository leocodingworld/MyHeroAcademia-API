<?php

namespace Database\Factories;

use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Personal>
 */
class PersonalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
		$ids = Usuario::all(["idUsuario"]);

        return [
            "idPersonal" => $this -> faker -> randomElement($ids),
			"numSegSocial" => "00123456789",
			"puesto" => $this -> faker -> randomElement(["Profesor", "Administrativo", "Sustituto"])
        ];
    }
}
