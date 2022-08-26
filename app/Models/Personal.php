<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    use HasFactory;

	protected $table = "personal";
	protected $primaryKey = "id";
	public $incrementing = false;
	public $timestamps = false;

	protected $filliable = [
		"id",
		"numSegSocial",
		"puesto"
	];
}
