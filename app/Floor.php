<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Floor extends Model {
	protected $table = 'floors';
    protected $primaryKey ='fid';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['uid','pid', 'content','pics','at_users'];

	//

}
