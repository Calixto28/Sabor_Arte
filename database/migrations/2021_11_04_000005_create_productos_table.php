<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('producto_descripcion');
            $table->longText('producto_detalle')->nullable();
            $table->string('producto_receta')->nullable();
            $table->string('multimedia')->nullable();
            $table->double('precio');
            $table->boolean('es_nuevo');
            $table->integer('id_subcategoria');
            $table->integer('orden');
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
        Schema::dropIfExists('productos');
    }
}
