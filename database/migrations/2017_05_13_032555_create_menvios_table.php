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
            $table->unSignedInteger('user_id');
            $table->unSignedInteger('facultad_id');
            $table->unSignedInteger('sede_id');
            $table->date('fenvio');
            $table->date('flimite');
            $table->string('tx_need',100);
            $table->unSignedInteger('envio1')->default(0);
            $table->unSignedInteger('envio2')->default(0);
            $table->unSignedInteger('rpta1')->default(0);
            $table->unSignedInteger('rpta2')->default(0);
            $table->string('tipo', 4);
        //    $table->string('tablename', 20)->nullable();
            $table->boolean('sw_envio')->default(false);

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
