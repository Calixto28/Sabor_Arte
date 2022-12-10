<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatPerfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cat_perfiles', function (Blueprint $table) {
            $table->id();
            $table->string('perfil_descripcion');
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
        Schema::dropIfExists('cat_perfiles');
    }
}
