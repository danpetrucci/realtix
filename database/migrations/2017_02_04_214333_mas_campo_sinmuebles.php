<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MasCampoSinmuebles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inmuebles', function (Blueprint $table) {
            $table->char('tipo_doc', 4)->after('apellido_dueno');
            $table->string('doc')->after('tipo_doc');
            $table->tinyInteger('apoderado')->after('domicilio_dueno');
            $table->integer('pais_dueno')->unsigned()->after('email_dueno');
            $table->integer('departamento_dueno')->unsigned()->after('pais_dueno')->nullable();
            $table->integer('ciudad_dueno')->unsigned()->after('departamento_dueno')->nullable();
            $table->string('observacion_dueno')->after('apoderado');

        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inmuebles', function (Blueprint $table) {
            $table->dropColumn('tipo_doc');
            $table->dropColumn('doc');
            $table->dropColumn('apoderado');
            $table->dropColumn('pais_dueno');
            $table->dropColumn('departamento_dueno');
            $table->dropColumn('ciudad_dueno');
            $table->dropColumn('observacion_dueno');
        });
    }
}
