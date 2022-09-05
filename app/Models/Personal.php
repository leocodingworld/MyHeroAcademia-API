<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
	protected $table = "personal";
	protected $primaryKey = "id";
	public $incrementing = false;
	public $timestamps = false;

	protected $filliable = [
		"id",
		"numSegSocial",
		"puesto"
	];

	public function info() {
		return $this -> belongsTo(Usuario::class, "id", "id");
	}

	public function curso() {
		return $this -> hasOne(Curso::class, "tutor", "id");
	}

	public function modulo() {
		return $this -> hasMany(Modulo::class, "tutor", "id");
	}
}
