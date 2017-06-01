<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDhorasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dhoras', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('facultad_id')->unsigned();
            $table->integer('sede_id')->unsigned();
            $table->string('wfranja',6);
/**            $table->boolean('D1_H10')->default(false);
            $table->boolean('D1_H11')->default(false);
            $table->boolean('D1_H12')->default(false);
            $table->boolean('D1_H13')->default(false);
            $table->boolean('D1_H21')->default(false);
            $table->boolean('D1_H22')->default(false);
            $table->boolean('D1_H31')->default(false);
            $table->boolean('D1_H32')->default(false);
            $table->boolean('D1_H33')->default(false);
            $table->boolean('D2_H10')->default(false);
            $table->boolean('D2_H11')->default(false);
            $table->boolean('D2_H12')->default(false);
            $table->boolean('D2_H13')->default(false);
            $table->boolean('D2_H21')->default(false);
            $table->boolean('D2_H22')->default(false);
            $table->boolean('D2_H31')->default(false);
            $table->boolean('D2_H32')->default(false);
            $table->boolean('D2_H33')->default(false);
            $table->boolean('D3_H10')->default(false);
            $table->boolean('D3_H11')->default(false);
            $table->boolean('D3_H12')->default(false);
            $table->boolean('D3_H13')->default(false);
            $table->boolean('D3_H21')->default(false);
            $table->boolean('D3_H22')->default(false);
            $table->boolean('D3_H31')->default(false);
            $table->boolean('D3_H32')->default(false);
            $table->boolean('D3_H33')->default(false);
            $table->boolean('D4_H10')->default(false);
            $table->boolean('D4_H11')->default(false);
            $table->boolean('D4_H12')->default(false);
            $table->boolean('D4_H13')->default(false);
            $table->boolean('D4_H21')->default(false);
            $table->boolean('D4_H22')->default(false);
            $table->boolean('D4_H31')->default(false);
            $table->boolean('D4_H32')->default(false);
            $table->boolean('D4_H33')->default(false);
            $table->boolean('D5_H10')->default(false);
            $table->boolean('D5_H11')->default(false);
            $table->boolean('D5_H12')->default(false);
            $table->boolean('D5_H13')->default(false);
            $table->boolean('D5_H21')->default(false);
            $table->boolean('D5_H22')->default(false);
            $table->boolean('D5_H31')->default(false);
            $table->boolean('D5_H32')->default(false);
            $table->boolean('D5_H33')->default(false);
            $table->boolean('D6_H10')->default(false);
            $table->boolean('D6_H11')->default(false);
            $table->boolean('D6_H12')->default(false);
            $table->boolean('D6_H13')->default(false);
            $table->boolean('D6_H21')->default(false);
            $table->boolean('D6_H22')->default(false);
            $table->boolean('D6_H31')->default(false);
            $table->boolean('D6_H32')->default(false);
            $table->boolean('D6_H33')->default(false);
            $table->boolean('sw_cambio')->default(false);
*/

            //$table->integer('semestr_id')->unsigned();

            //$table->foreign('semestr_id')->references('id')->on('semestres')->onDelete('cascade');
            //$table->foreign('sede_id')->references('id')->on('sedes')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

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
        Schema::drop('dhoras');
    }
}
