<?php namespace App\Http\Controllers\API;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;
Use App\Floor;
use App\Post;

class FloorController extends Controller {

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
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		if(!Auth::check()){
	       return response()->json(["errno"=>2,"msg"=>"require authentication"]);
		}
		$pid=$request->input('pid');
		$content=$request->input('content');
		if((!$pid)||(!$content)){
			return response()->json(["errno"=>1,"msg"=>"require pid and content"]);
		}
	
		$post=Post::find($pid);
		if(!$post){
			return response()->json(["errno"=>3,"msg"=>"post not found"]);
		}
		
		$floor = new Floor;
		$floor->pid=$pid;
		$floor->uid=Auth::user()->id;
		$floor->content=$content;
		$floor->pics=$request->input("pics");
		$floor->at_users=$request->input("at_users");
		
		$floor->save();
		
		return response()->json(["errno"=>0,"msg"=>"success",'floor'=>$floor]);
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
            return response()->json(["errno"=>2,"msg"=>"require authentication"]);
        }
		$floor=Floor::find($id);
		if(!$floor){
			return response()->json(['errno'=>3,'msg'=>'floor not fount']);
		}
		if($floor->uid!==Auth::user()->id){
			return response()->json(['errno'=>1,'msg'=>'this floor does not belong to you']);
		}

		$comments=$floor->comments;
		foreach($comments as $c){
			$c->delete();
		}
		$floor->delete();
	
        return response()->json(['errno'=>0,'msg'=>'success']);
	}

}
