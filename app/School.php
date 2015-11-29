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
    protected $primaryKey ='sc_id';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email_tail','pics','text'];

}
