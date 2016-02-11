<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMetaTags extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meta_tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->default('');
            $table->string('meta_title')->default('');
            $table->string('meta_description')->default('');
            $table->string('meta_keywords')->default('');
        });

        Schema::table('meta_tags', function (Blueprint $table) {
            $table->index('title');
            $table->index('meta_title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meta_tags');
    }
}
