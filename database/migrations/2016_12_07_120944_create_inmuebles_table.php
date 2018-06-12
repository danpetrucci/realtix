<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInmueblesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inmuebles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo')->unique();
            $table->tinyInteger('status');
            $table->integer('inmobiliarias_id')->unsigned();
            $table->integer('user_id')->unsigned();        
            $table->string('asesor');

            $table->string('nombre_dueno');
            $table->string('apellido_dueno');
            $table->string('telefono_dueno');
            $table->string('email_dueno');
            $table->string('domicilio_dueno');

            $table->integer('pais_id')->unsigned();
            $table->integer('departamento_id')->unsigned();
            $table->integer('municipio_id')->unsigned();
            $table->string('orientacion');
            $table->string('comuna');
            $table->string('barrio');
            $table->string('direccion');
            $table->float('latitud', 10, 6);
            $table->float('longitud', 10, 6);

            $table->string('publicacion');
            $table->string('tipo_negocio');
            $table->string('estado_fisico');
            $table->string('tipo_propiedad');
            $table->string('tipo_propiedad_detalle');
            $table->tinyInteger('estrato');
            $table->tinyInteger('edad')->nullable();
            $table->tinyInteger('piso_ubicacion')->nullable();
            $table->tinyInteger('niveles')->nullable();
            $table->tinyInteger('habitaciones')->nullable();
            $table->tinyInteger('banos')->nullable();
            $table->tinyInteger('garajes')->nullable();
            $table->tinyInteger('depositos')->nullable();
            $table->tinyInteger('estudios')->nullable();
            $table->integer('area_terreno')->nullable();
            $table->string('area_terreno_unidad')->nullable();
            $table->integer('area_construida')->nullable();
            $table->integer('area_privada')->nullable();
            $table->string('tipo_moneda');
            $table->decimal('valor_metro', 9, 2)->nullable();
            $table->decimal('valor', 9, 2);
            $table->decimal('precio', 9, 2);
            $table->decimal('administracion', 7, 2)->nullable();
            $table->decimal('comision', 3, 2);

            $table->string('youtubelink')->nullable();
            $table->string('imagenes');
            $table->string('documentos')->nullable();

            $table->boolean('comision_compartida');   
            $table->tinyInteger('porcentaje')->nullable();         
            $table->boolean('publicar_otras');
            $table->boolean('comparte_red');
            $table->boolean('propiedad_horizontal');
            $table->string('caracteristicas_externas')->nullable();
            $table->string('caracteristicas_internas')->nullable();
            $table->string('nota')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('inmuebles', function($table) {
            $table->foreign('user_id')->references('id')->on('user');
            $table->foreign('inmobiliarias_id')->references('id')->on('inmobiliarias');
            $table->foreign('pais_id')->references('id')->on('paises');
            $table->foreign('departamento_id')->references('id')->on('departamentos');
            $table->foreign('municipio_id')->references('id')->on('municipios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('inmuebles');
    }
}
