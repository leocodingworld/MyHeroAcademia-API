<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() : bool
    {
        return true;
    }

	public function messages() : array
	{
		return [
			"email.required" => "El campo Email no puede estar vacío",
			"password.required" => "El campo Contraseña no puede estar vacío"
		];
	}

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
        return [
            "email" => "required|email",
			"password" => "required"
        ];
    }
}
