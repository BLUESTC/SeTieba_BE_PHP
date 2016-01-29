<?php namespace App\Commands;

use App\Commands\Command;

use DB;
use User;
use Cache;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class Notice extends Command implements SelfHandling, ShouldBeQueued {

	use InteractsWithQueue, SerializesModels;
	protected $author_id,$post_id,$message,$message_type;
	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct($author,$post,$message="",$message_type='new_post')
	{
		$this->author_id=$author;
		$this->post_id=$post;
		$this->message=$message;
		$this->message_type=$message_type;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
		switch ($this->message_type) {
			case 'new_post':
				$this->new_posts();
				break;
			case 'new_commit':
				new_commit();
				break;
			default:
				# code...
				break;
		}
		//Cache::forever($this->author_id,$this->post_id);//将要推广的用户放入id
	}
	public function new_posts(){//新的帖子发布，需要通知所有关注此人的人
			foreach ($this->Finding_target($this->author_id,'author') as $target ){
				//循环处理每个关注了此人的登陆用户
				$userAgent=Cache::get($target->follow_id);
				switch ($userAgent) {
					case 'WP':
						//执行WP推送方案
						$this->Sending_WP();
						break;
					case 'IOS':
						//执行IOS推送方案
						$this->Sending_IOS();
						break;
					case 'Android':
						//执行安卓推送方案
						$this->Sending_Anroid();
						break;
					default:
						//用户没有登录或者是在网络端登陆，不进行推送
						break;
				}
			}
	}
	public function new_commit(){//通知发帖人，你的帖子被人评论了
		$userAgent=Cache::get($author_id);
		switch ($userAgent) {
			case 'WP':
				//执行WP推送方案
				$this->Sending_WP();
				break;
			case 'IOS':
				//执行IOS推送方案
				$this->Sending_IOS();
				break;
			case 'Android':
				//执行安卓推送方案
				$this->Sending_Anroid();
				break;
			default:
				//用户没有登录或者是在网络端登陆，不进行推送
				break;
		}
	}


	public function Finding_target($message_author,$author_type='author'){//作者，贴吧，系统
		//查询数据库或者缓存空间，找到需要推送的对象
		switch ($author_type) {
			case 'author'://去author_follow表里寻找
				$targets=DB::table('author_follow')
				->where('author_id',$message_author)->get();
				break;
			case 'bas'://去user_ba表里寻找
				$targets=DB::table('ba_user')
				->where('user_id',$message_author)->get();
				break;
			default://系统通知，应该下发至所有用户
				$targets=DB::table('users')->get();
				break;
		}
		//var_dump($targets);
		return $targets;
	}

	public function Sending_WP($request=null){
		echo"$this->message";
	}

	public function Sending_IOS($request=null){
		echo"$this->message";
	}

	public function Sending_Anroid($request=null){
		echo"$this->message";
	}
}
