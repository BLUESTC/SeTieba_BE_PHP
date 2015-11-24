<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class School extends Model {

	//
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'schools';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['sc_id','name', 'email_tail','pics','text'];

}
