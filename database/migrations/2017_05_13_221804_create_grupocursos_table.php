<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGrupocursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupocursos', function (Blueprint $table) {
            $table->increments('id');
            //$table->string('semestre',6);
            $table->string('cgrupo',3);
            $table->string('ccurso',6);

            //$table->integer('semestr_id')->unsigned();
            $table->integer('grupo_id')->unsigned();
            $table->integer('curso_id')->unsigned();
            $table->boolean('sw_cambio');
            
            //$table->foreign('semestr_id')->references('id')->on('semestres')->onDelete('cascade');
            $table->foreign('grupo_id')->references('id')->on('grupos')->onDelete('cascade');
            $table->foreign('curso_id')->references('id')->on('cursos')->onDelete('cascade');
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
        Schema::drop('grupocursos');
    }
}
