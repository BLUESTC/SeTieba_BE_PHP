<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Comment;
use App\Post;

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
	public function post(){
		return $this->belongTo('App\Post','pid','pid');
	}
	public function comments(){
		return $this->hasMany('App\Comment','to_fid','fid');
	}
}
