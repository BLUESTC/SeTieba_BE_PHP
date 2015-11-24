<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Floor extends Model {
	protected $table = 'floors';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['uid', 'fid','pid', 'content','pics','at_users','created_at','updated_at'];

	//

}
