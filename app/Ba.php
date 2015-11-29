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
    protected $primaryKey ='b_id';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name','desc_text','pics'];

}
