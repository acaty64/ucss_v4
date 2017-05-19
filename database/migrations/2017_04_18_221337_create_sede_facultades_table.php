<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSedeFacultadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sede_facultades', function (Blueprint $table) {
            $table->increments('id');
            
            $table->unSignedInteger('sede_id');
            $table->foreign('sede_id')->references('id')->on('sedes');
            
            $table->unSignedInteger('facultad_id');
            $table->foreign('facultad_id')->references('id')->on('facultades');

            $table->rememberToken();
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
        Schema::dropIfExists('sede_facultades');
    }
}
