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
            $table->unSignedInteger('user_id');
            $table->unSignedInteger('menvio_id');
            $table->string('email_to');
            $table->string('email_cc')->nullable();
            $table->boolean('sw_envio')->default(false);
            $table->boolean('sw_rpta1')->default(false);
            $table->boolean('sw_rpta2')->default(false);
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
