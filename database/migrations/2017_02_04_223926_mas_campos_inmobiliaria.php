<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MasCamposInmobiliaria extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inmobiliarias', function (Blueprint $table) {
            $table->string('pais_inmo')->after('nit');
            $table->string('departamento_inmo')->after('pais_inmo')->nullable();
            $table->renameColumn('ciudad', 'ciudad_inmo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inmobiliarias', function (Blueprint $table) {
            $table->dropColumn('pais_inmo');
            $table->dropColumn('departamento_inmo');
            $table->renameColumn('ciudad_inmo', 'ciudad')->nullable();
        });
    }
}
