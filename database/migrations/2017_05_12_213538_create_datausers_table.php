<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatausersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datausers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('wdoc1', 30);
            $table->string('wdoc2', 30)->nullable();
            $table->string('wdoc3', 30)->nullable();
            $table->string('cdocente',6);
            $table->string('fono1', 12)->nullable();
            $table->string('fono2', 12)->nullable();
            $table->string('email1', 80);
            $table->string('email2', 80)->nullable();
            $table->boolean('whatsapp')->default(false);
            $table->integer('user_id')->unsigned();
            
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
        Schema::table('datausers', function (Blueprint $table) {
            Schema::drop('datausers');
        });
    }
}
