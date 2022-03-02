<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConocimientoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conocimiento', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('manifiesto_id');
            $table->string('codigo')->nullable();
            $table->string('puerto')->nullable();
            $table->string('master')->nullable();
            $table->string('detalle')->nullable();
            $table->string('terminal')->nullable();
            $table->unsignedBigInteger('peso_org')->nullable();
            $table->unsignedBigInteger('bulto_org')->nullable();
            $table->unsignedBigInteger('peso_man')->nullable();
            $table->unsignedBigInteger('bulto_man')->nullable();
            $table->unsignedBigInteger('peso_rcb')->nullable();
            $table->unsignedBigInteger('bulto_rcb')->nullable();
            $table->string('consignatario')->nullable();
            $table->string('embarcador')->nullable();
            $table->date('fec_trans')->nullable();
            $table->timestamps();
            //$table->softDeletes();
            $table->foreign('manifiesto_id')
                ->references('id')
                ->on('manifiesto')
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
        Schema::dropIfExists('conocimiento');
    }
}
