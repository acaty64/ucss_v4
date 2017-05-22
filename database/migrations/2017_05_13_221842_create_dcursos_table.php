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
            $table->integer('facultad_id')->unsigned();
            $table->integer('sede_id')->unsigned();
            //$table->string('semestre',6);
            //$table->string('ccurso',6);
            //$table->string('cdocente',6);
            //$table->integer('orden');
            $table->integer('prioridad');
            $table->boolean('sw_cambio')->default(false);
            
            //$table->integer('semestr_id')->unsigned();
            $table->integer('curso_id')->unsigned();
            $table->integer('user_id')->unsigned();

            //$table->foreign('semestr_id')->references('id')->on('semestres')->onDelete('cascade');
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
