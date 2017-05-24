<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserGruposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usergrupos', function (Blueprint $table) {
            $table->increments('id');
            $table->unSignedInteger('user_id');
            $table->unSignedInteger('grupo_id');
            $table->unSignedInteger('facultad_id');
            $table->unSignedInteger('sede_id');
            $table->string('cgrupo');
            $table->string('cdocente');
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('grupo_id')->references('id')->on('grupos')->onDelete('cascade');
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
        Schema::drop('usergrupos');
    }
}
