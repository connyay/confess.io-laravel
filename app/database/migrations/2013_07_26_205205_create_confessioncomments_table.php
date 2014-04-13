<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateConfessionCommentsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create the `confession_comments` table
        Schema::create('confession_comments', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('confession_id');
			$table->text('content');
			$table->string('pass');
            $table->boolean('approved')->default(false);
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
        // Create the `confession_comments` table
        Schema::drop('confession_comments');
    }

}
