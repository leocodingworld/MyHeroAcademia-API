<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    use HasFactory;

	protected $table = "modulos";
	protected $primaryKey = "id"; // No se pueden crear Claves Compuestas
	public $incrementing = false;
	public $timestamps = false;

	public function cursoInfo() {
		return $this -> belongsTo(Curso::class, "curso", "id");
	}

	protected $fillable = [
		"id",
		"nombre",
		"nombreCorto",
		"nivel",
		"profesor",
		"horas",
		"curso"
	];
}
