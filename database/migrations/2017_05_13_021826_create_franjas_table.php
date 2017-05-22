<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFranjasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('franjas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('facultad_id')->unsigned();
            $table->integer('sede_id')->unsigned();
            $table->integer('dia');
            $table->integer('turno');
            $table->integer('hora');
            $table->string('wfranja',11);
            //$table->string('cfacultad');
            //$table->string('csede');


            //$table->foreign('semestr_id')->references('id')->on('semestres')->onDelete('cascade');
            //$table->foreign('sede_id')->references('id')->on('sedes')->onDelete('cascade');
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
        Schema::drop('franjas');
    }
}
