<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PostTagsPivot extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_tag_post', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('blog_tag_id')->unsigned()->index();
            $table->integer('post_id')->unsigned()->index();

            $table->foreign('blog_tag_id')->references('id')->on('blog_tags')->onDelete('cascade');
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_tag_post');
    }
}
