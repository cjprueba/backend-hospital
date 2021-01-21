<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultation', function (Blueprint $table) {
            $table->id();
            $table->string("description");
            $table->unsignedBigInteger('fk_customer');
            $table->unsignedBigInteger('fk_doctor');
            $table->timestamps();
        });

        Schema::table('consultation', function($table) {
            $table->foreign('fk_customer')->references('id')->on('users');
            $table->foreign('fk_doctor')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('consultation');
    }
}
