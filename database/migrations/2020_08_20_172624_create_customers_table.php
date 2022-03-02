<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('business_id');
            $table->unsignedBigInteger('district_id');
            $table->string('name',100);
            $table->string('alias',100);
            $table->string('address',100);
            $table->string('ruc',11);
            $table->string('code',3);
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['code', 'deleted_at']);
            $table->foreign('business_id')
                ->references('id')
                ->on('bussiness')
                ->onDelete('cascade');
            $table->foreign('district_id')
                ->references('id')
                ->on('districts')
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
        Schema::dropIfExists('customers');
    }
}
