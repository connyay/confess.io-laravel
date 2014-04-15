<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateConfessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create the `confessions` table
        Schema::create('confessions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('hash', 6);
            $table->text('confession');
            $table->string('pass', 6);
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
        // Delete the `confessions` table
        Schema::drop('confessions');
    }

}
