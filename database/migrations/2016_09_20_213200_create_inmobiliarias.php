<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInmobiliarias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('inmobiliarias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre')->unique();
            $table->string('ciudad')->nullable();
            $table->string('direccion')->nullable();
            $table->string('telefono')->nullable(); 
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('inmobiliarias');
    }
}
