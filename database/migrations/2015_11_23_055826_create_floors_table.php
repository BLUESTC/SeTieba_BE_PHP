<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFloorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('floors', function(Blueprint $table)
		{
            $table->increments('fid');
            $table->integer('pid')->unsigned();
            $table->integer('uid')->unsigned();
            $table->string('content');
            $table->json('pics')->nullable();
            $table->json('at_users')->nullable();
            $table->timestamps();
            $table->foreign('uid')->references('id')->on('users');
            $table->foreign('pid')->references('pid')->on('posts');
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('floors');
	}

}
