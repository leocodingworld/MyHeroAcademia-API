<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Define el Tipo de usuario de la aplicación
 */
class Tipo extends Model
{
    use HasFactory;

	protected $table = "tipos";
	protected $primaryKey = "idTipo";
	public $incrementing = true;
	public $timestamps = false;

	protected $filliable = [
		"nombre"
	];

	protected $hidden = [
		"idTipo"
	];
}
