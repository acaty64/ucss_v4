<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_type', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('type_id')->unsigned();
            $table->foreign('type_id')->references('id')->on('types');
            
            $table->integer('menu_id')->unsigned();
            $table->foreign('menu_id')->references('id')->on('menus');

            $table->integer('level');
            $table->integer('order');
            
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
        Schema::dropIfExists('menu_type');
    }
}
