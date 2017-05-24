<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGruposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupos', function (Blueprint $table) {
            $table->increments('id');
            $table->unSignedInteger('facultad_id');
            $table->unSignedInteger('sede_id');
            
            $table->string('cgrupo',3);
            $table->string('wgrupo',50);

            //$table->integer('semestr_id')->unsigned();
            
            //$table->foreign('semestr_id')->references('id')->on('semestres')->onDelete('cascade');
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
        Schema::drop('grupos');
    }
}
