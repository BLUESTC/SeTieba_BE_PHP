<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('posts', function(Blueprint $table)
		{
            $table->increments('pid');
            $table->integer('uid')->unsigned();
            $table->string('title');
            $table->string('content');
            $table->json('pics')->nullable();
            $table->integer('subject_id')->unsigned();
            $table->integer('ba_id')->unsigned();
            $table->json('at_users')->nullable();
            $table->timestamp('last_comment_at');
            $table->bigInteger('last_comment_id');
            $table->timestamps();
            $table->foreign('uid')->references('id')->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('posts');
	}

}
