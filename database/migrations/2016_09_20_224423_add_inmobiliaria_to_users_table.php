<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddInmobiliariaToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
             $table->integer('inmobiliarias_id')->after('telefono')->unsigned()->nullable();
        });
        
        Schema::table('users', function (Blueprint $table) {
                $table->foreign('inmobiliarias_id')
                    ->references('id')->on('inmobiliarias') 
                    ->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['inmobiliarias_id']);
        });
    }
}
