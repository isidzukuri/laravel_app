<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOnes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->default('no_namer');
            $table->integer('awesomeness')->default(0);
            $table->string('power')->default('pure');
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
        Schema::dropIfExists('ones');
    }
}
