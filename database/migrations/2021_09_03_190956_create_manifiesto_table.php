<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManifiestoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manifiesto', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->nullable();
            $table->unsignedBigInteger('nro_bultos')->nullable();
            $table->unsignedBigInteger('peso_bruto')->nullable();
            $table->date('fec_zarpe')->nullable();
            $table->date('fec_embarque')->nullable();
            $table->string('nave')->nullable();
            $table->string('nacionalidad')->nullable();
            $table->string('empresa')->nullable();
            $table->date('fec_aut_carga')->nullable();
            $table->date('fec_transmision')->nullable();
            $table->unsignedBigInteger('nro_detalles')->nullable();
            $table->string('tipo',20)->nullable();
            $table->timestamps();
            //$table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('manifiesto');
    }
}
