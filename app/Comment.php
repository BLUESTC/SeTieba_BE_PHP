<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model {
	protected $table = 'comments';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['from_id','to_id', 'cid', 'content','pics','at_users','created_at','updated_at'];

	//

}
