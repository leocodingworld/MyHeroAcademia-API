<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("usuarios", function(Blueprint $table) {
            $table -> id();
            $table -> string("nombre", 20);
            $table -> string("apellidos", 25);
            $table -> string("direccion", 50);
            $table -> string("email", 40) -> unique();
            $table -> string("password", 64);
            $table -> boolean("activo") -> default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists("usuarios");
    }
};
