<?php namespace App\Http\Controllers\API;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;
use App\Comment;
use App\Floor;
/* 
 *评论控制器
 */
class CommentController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		if(!Auth::check()){
			return response()->json(['errno'=>2,'msg'=>'require authentication']);
		}
		$fid=$request->input('fid');
		$content=$request->input('content');
		
		if((!$fid)||(!$content)){
			return response()->json(['errno'=>1,'msg'=>'require fid and content']);
		}
		
		$floor=Floor::find($fid);
		if(!$floor){
			return response()->json(['errno'=>3,'msg'=>'floor not found']);
		}
		
		$comm=new Comment;
		$comm->from_id=Auth::user()->id;
		$comm->to_id=$floor->uid;
		$comm->to_pid=$floor->pid;
		$comm->to_fid=$floor->fid;
		$comm->content=$content;
		$comm->at_users=$request->input('at_users');
		$comm->pics-$request->input('pics');
		
		$comm->save();	
		//更新最后更新时间戳
		$comm->floor->touch();
		$comm->floor->post->touch();	

		return response()->json(['errno'=>0,'msg'=>'success','comment'=>$comm]);
		
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if(!(Auth::check())){
            return response()->json(['errno'=>2,'msg'=>'require authentication']);
        }
		$c=Comment::find($id);
		if(!$floor){
			return response()->json(['errno'=>3,'msg'=>'Comment not fount']);
		}
		if($floor->uid!==Auth::user()->id){
			return response()->json(['errno'=>1,'msg'=>'this comment does not belong to you']);
		}
		
		c->delete();
        return response()->json(['errno'=>0,'msg'=>'success']);
	}

}
