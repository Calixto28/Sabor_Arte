<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpcionesMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opciones_menu', function (Blueprint $table) {
            $table->id();
            $table->string('etiqueta');
            $table->string('url')->nullable();
            $table->string('fa_icon')->nullable();
            $table->integer('orden');
            $table->integer('parent_menu_id');
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
        Schema::dropIfExists('opciones_menu');
    }
}
