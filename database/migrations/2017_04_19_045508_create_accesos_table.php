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
            //$table->foreign('user_id')->references('id')->on('users');

            $table->unSignedInteger('facultad_id');
            //$table->foreign('facultad_id')->references('id')->on('facultades');

            $table->unSignedInteger('sede_id');
            //$table->foreign('sede_id')->references('id')->on('sedes');

            $table->unSignedInteger('type_id');

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
