<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model {
    protected $table = 'comments';
    protected $primaryKey ='cid';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['from_id','to_id', 'content','pics','at_users'];

	//

}
