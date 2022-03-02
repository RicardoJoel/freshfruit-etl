<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('contact_type_id');
            $table->unsignedBigInteger('customer_id');
            $table->string('fullname',100);
            $table->string('position',100);
            $table->date('birthdate')->nullable();
            $table->string('email',50);
            $table->string('telephone',7)->nullable();
            $table->string('mobile',9)->nullable();
            $table->string('annex',4)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('contact_type_id')
                ->references('id')
                ->on('contact_types')
                ->onDelete('cascade');
            $table->foreign('customer_id')
                ->references('id')
                ->on('customers')
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
        Schema::dropIfExists('contacts');
    }
}
