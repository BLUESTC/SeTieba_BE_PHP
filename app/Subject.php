<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model {
	protected $table = 'subjects';
    protected $primaryKey ='sid';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['subject','pics','text'];


}
