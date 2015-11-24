<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Ba extends Model 
{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'bas';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['b_id','name'];


}
