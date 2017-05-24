<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDcursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dcursos', function (Blueprint $table) {
            $table->increments('id');
            $table->unSignedInteger('facultad_id');
            $table->unSignedInteger('sede_id');
            $table->unSignedInteger('user_id');
            $table->unSignedInteger('prioridad');
            
            $table->unSignedInteger('curso_id');

            $table->boolean('sw_cambio')->default(false);

            $table->foreign('curso_id')->references('id')->on('cursos')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('dcursos');
    }
}
