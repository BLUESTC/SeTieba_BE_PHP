<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model {
    protected $table = 'comments';
    protected $primaryKey ='cid';
	
	use SoftDeletes;

    protected $dates = ['deleted_at'];
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['from_id','to_id','to_pid','to_fid', 'content','pics','at_users'];

    //

    public function floor(){
        return $this->belongTo('App\Floor','fid','to_fid');
    } 

    public function user(){
        return $this->belongTo('App\User','id','from_id');
    }
}
