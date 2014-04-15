<?php

use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create the `blog_posts` table
        Schema::create('blog_posts', function ($table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('title');
            $table->string('slug');
            $table->text('content');
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
        // Delete the `blog_posts` table
        Schema::drop('blog_posts');
    }

}
