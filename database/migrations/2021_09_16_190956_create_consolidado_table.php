<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsolidadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consolidado', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('manifiesto_id')->nullable();
            $table->unsignedBigInteger('conocimiento_id')->nullable();
            $table->unsignedBigInteger('detalle_id')->nullable();
            $table->unsignedBigInteger('contenedor_id')->nullable();
            $table->unsignedBigInteger('producto_id')->nullable();
            $table->unsignedBigInteger('variedad_id')->nullable();
            $table->unsignedBigInteger('presentacion_id')->nullable();
            $table->boolean('organico');
            $table->string('tipo_man',20)->nullable();
            $table->string('manifiesto')->nullable();
            $table->string('nave')->nullable();
            $table->string('empresa')->nullable();
            $table->string('num_detalles')->nullable();
            $table->date('fecha_salida')->nullable();
            $table->string('conocimiento')->nullable();
            $table->string('detalle_con')->nullable();
            $table->string('puerto')->nullable();
            $table->unsignedBigInteger('peso_man')->nullable();
            $table->unsignedBigInteger('bultos_man')->nullable();
            $table->string('consignatario_con')->nullable();
            $table->string('embarcador_con')->nullable();
            $table->date('fecha_transm')->nullable();
            $table->unsignedBigInteger('num_bultos')->nullable();
            $table->unsignedBigInteger('peso_bruto')->nullable();
            $table->string('embarcador_det')->nullable();
            $table->string('consignatario_det')->nullable();
            $table->string('marcas_numeros')->nullable();
            $table->string('descripcion')->nullable();
            $table->string('numero')->nullable();
            $table->unsignedBigInteger('tamanio')->nullable();
            $table->string('condicion')->nullable();
            $table->string('tipo_cont')->nullable();
            $table->string('operador')->nullable();
            $table->unsignedBigInteger('tara')->nullable();
            $table->timestamps();
            //$table->softDeletes();
            $table->foreign('manifiesto_id')
                ->references('id')
                ->on('manifiesto')
                ->onDelete('cascade');
            $table->foreign('conocimiento_id')
                ->references('id')
                ->on('conocimiento')
                ->onDelete('cascade');
            $table->foreign('detalle_id')
                ->references('id')
                ->on('detalle')
                ->onDelete('cascade');
            $table->foreign('contenedor_id')
                ->references('id')
                ->on('contenedor')
                ->onDelete('cascade');
            $table->foreign('producto_id')
                ->references('id')
                ->on('productos')
                ->onDelete('cascade');
            $table->foreign('variedad_id')
                ->references('id')
                ->on('variedades')
                ->onDelete('cascade');
            $table->foreign('presentacion_id')
                ->references('id')
                ->on('presentaciones')
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
        Schema::dropIfExists('consolidado');
    }
}
