<?php namespace App;

use Illuminate\Database\Eloquent\Model;
//帖子模型
class Post extends Model {
	protected $table = 'posts';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['uid', 'pid', 'title','content','pics','ba_id','subject_id','at_users','created_at','last_comment_at','last_comment_id','updated_at'];

	//

}
