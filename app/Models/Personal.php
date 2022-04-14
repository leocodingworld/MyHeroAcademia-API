<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    use HasFactory;

	protected $table = "personal";
	protected $primaryKey = "idPersonal";
	public $incrementing = false;
	public $timestamps = false;

	public function idPersonal() {
		return $this -> hasMany(Usuario::class, "idPersonal");
	}

	protected $filliable = [
		"numSegSocial",
		"puesto"
	];
}
