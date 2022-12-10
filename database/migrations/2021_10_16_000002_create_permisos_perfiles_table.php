<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermisosPerfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permisos_perfiles', function (Blueprint $table) {
            $table->id();
            $table->integer('id_perfil');
            $table->integer('id_menu');
            $table->integer('id_estatus');
            $table->integer('creator_user_id');
            $table->integer('updater_user_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permisos_perfiles');
    }
}
