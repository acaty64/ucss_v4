<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenviosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menvios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('facultad_id')->unsigned();
            $table->integer('sede_id')->unsigned();
            $table->date('fenvio');
            $table->date('flimite');
            $table->string('tx_need',100);
            $table->integer('envio1');
            $table->integer('envio2');
            $table->integer('rpta1');
            $table->integer('rpta2');
            $table->string('tipo', 4);
            $table->string('tablename', 20);
            $table->boolean('sw_envio');

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
        Schema::drop('menvios');
    }
}
