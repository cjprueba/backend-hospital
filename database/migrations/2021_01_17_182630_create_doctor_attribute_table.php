<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorAttributeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_attribute', function (Blueprint $table) {
            $table->id();
            $table->string("crm");
            $table->unsignedBigInteger('fk_doctor');
            $table->timestamps();
        });

        Schema::table('doctor_attribute', function($table) {
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
        Schema::dropIfExists('doctor_attribute');
    }
}
