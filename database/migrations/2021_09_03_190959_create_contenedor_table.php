<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContenedorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contenedor', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('conocimiento_id');
            $table->string('numero')->nullable();
            $table->unsignedBigInteger('tamanio')->nullable();
            $table->string('condicion')->nullable();
            $table->string('tipo')->nullable();
            $table->string('operador')->nullable();
            $table->unsignedBigInteger('tara')->nullable();
            $table->timestamps();
            //$table->softDeletes();
            $table->foreign('conocimiento_id')
                ->references('id')
                ->on('conocimiento')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contenedor');
    }
}
