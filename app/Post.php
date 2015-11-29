<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Floor;
//帖子模型
class Post extends Model {
	protected $table = 'posts';
    protected $primaryKey ='pid';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['uid', 'title','content','pics','ba_id','subject_id','at_users','last_comment_at','last_comment_id'];

	//
    public function user(){
        return $this->belongsTo('App\User','id','uid');
    }

    public function floors(){
        return $this->hasMany('App\Floor','pid','pid');
    }
	protected function getDateFormat()
    {
        return 'U';
    }
}
