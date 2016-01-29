<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthorFollowTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	 public function up()
 	{
 		Schema::create('author_follow', function(Blueprint $table)
 		{
 			$table->increments('id');
 			$table->integer('author_id')->unsigned();
 			$table->integer('follow_id')->unsigned();
 			$table->foreign('author_id')->references('id')->on('users');
 		    $table->foreign('follow_id')->references('id')->on('users');
 		});
 	}

 	/**
 	 * Reverse the migrations.
 	 *
 	 * @return void
 	 */
 	public function down()
 	{
 		Schema::drop('author_follow');
 	}

}
