<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccesosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accesos', function (Blueprint $table) {
            $table->increments('id');

            $table->unSignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unSignedInteger('facultad_id');
            //$table->foreign('facultad_id')->references('id')->on('facultades');

            $table->unSignedInteger('sede_id');
            //$table->foreign('sede_id')->references('id')->on('sedes');

            $table->unSignedInteger('type_id')->default(2);

            $table->string('wdocente')->default(false);
            
            $table->boolean('swcierre')->default(false);
            
            $table->boolean('disp_id')->default(0);
            $table->boolean('dhora')->default(false);
            $table->boolean('dcurso')->default(false);
            
            $table->boolean('carga_id')->default(0);
            $table->boolean('carga')->default(false);

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
        Schema::dropIfExists('accesos');
    }
}
