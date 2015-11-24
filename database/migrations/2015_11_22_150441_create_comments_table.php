<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('comments', function(Blueprint $table)
		{
            $table->increments('cid');
            $table->integer('from_id')->unsigned();
            $table->integer('to_id')->unsigned();
            $table->integer('to_pid')->unsigned();
            $table->string('content');
            $table->json('pics')->nullable();
            $table->json('at_users')->nullable();
            $table->timestamps();
            $table->foreign('from_id')->references('id')->on('users');
            $table->foreign('to_id')->references('id')->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('comments');
	}

}
