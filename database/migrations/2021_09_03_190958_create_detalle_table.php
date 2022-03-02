<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('conocimiento_id');
            $table->unsignedBigInteger('bultos')->nullable();
            $table->unsignedBigInteger('peso_bruto')->nullable();
            $table->string('empaques')->nullable();
            $table->string('embarcador')->nullable();
            $table->string('consignatario')->nullable();
            $table->string('marcas_numeros')->nullable();
            $table->string('descripcion')->nullable();
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
        Schema::dropIfExists('detalle');
    }
}
