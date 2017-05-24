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
            $table->unSignedInteger('facultad_id');
            $table->unSignedInteger('sede_id');
            $table->date('fenvio');
            $table->date('flimite');
            $table->string('tx_need',100);
            $table->unSignedInteger('envio1');
            $table->unSignedInteger('envio2');
            $table->unSignedInteger('rpta1');
            $table->unSignedInteger('rpta2');
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
