<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDenviosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('denvios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('facultad_id')->unsigned();
            $table->integer('sede_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('menvio_id')->unsigned();
            $table->string('email_to');
            $table->string('email_cc');
            $table->boolean('sw_envio');
            $table->boolean('sw_rpta');
            $table->string('tipo');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('menvio_id')->references('id')->on('menvios')->onDelete('cascade');
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
        Schema::drop('denvios');
    }
}
