<?php namespace App\Commands;

use App\Commands\Command;

use User;
use Cache;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class Notice extends Command implements SelfHandling, ShouldBeQueued {

	use InteractsWithQueue, SerializesModels;
	protected $user_id,$post_id;
	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct($user,$post)
	{
		//
		$this->user_id=$user;
		$this->post_id=$post;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
		foreach (Finding_target($this->user_id,'post') as $target_id ){
			//循环处理每个关注了此人的登陆用户
			$userAgent=Cache::get($target_id);
			switch ($userAgent) {
				case 'WP':
					//执行WP推送方案
					Sending_WP();
					break;
				case 'IOS':
					//执行IOS推送方案
					Sending_IOD();
					break;
				case 'Android':
					//执行安卓推送方案
					Sending_Anroid();
					break;
				default:
					//用户没有登录或者是在网络端登陆，不进行推送
					break;
			}

		}
		//Cache::forever($this->user_id,$this->post_id);//将要推广的用户放入id
	}

	public function Finding_target($message_author,$message_type='post'){
		//查询数据库或者缓存空间，找到需要推送的对象
	}

	public function Sending_WP($request=null){

	}

	public function Sending_IOS($request=null){

	}

	public function Sending_Anroid($request=null){

	}
}
