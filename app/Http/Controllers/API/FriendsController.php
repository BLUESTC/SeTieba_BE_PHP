<?php namespace App\Http\Controllers\API;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Illuminate\Support\Facades\DB;

class FriendsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$user=Auth::user();
		if(!Auth::check()){
			return response()->json(['errno'=>2,'msg'=>'require authentication']);
		}
		$follower=$user->followers;
		return response()->json(['errno'=>0,'msg'=>'success','follower'=>$follower]);
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
		$user=Auth::user();
		if(!Auth::check()){
			return response()->json(['errno'=>2,'msg'=>'require authentication']);
		}
		$author_id=$request->input('master_id');
		if(!$author_id){
			return response()->json(['errno'=>4,'msg'=>'require master_id']);
		}
		$author=User::find($author_id);
		$author->followers()->attach($user['id']);
		return response()->json(['errno'=>0,'msg'=>'success']);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return $this->index();
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
	 //要求格式需要是x-www-form-urlencoded
	public function destroy(Request $request)
	{
		$user=Auth::user();
		$author_id=$request->input('master_id');
		if(!$user){
			return response()->json(['errno'=>2,'msg'=>'require authentication']);
		}

		if(!$author_id){
			return response()->json(['errno'=>1,'msg'=>'require master_id']);
		}

		$user_id=$user->id;

		if (DB::table('author_follow')->where('author_id',$author_id)->where('follow_id',$user_id)->get()){
			DB::table('author_follow')->where('author_id',$author_id)->where('follow_id',$user_id)->delete();
			return response()->json(['errno'=>0,'msg'=>'success']);
		}
		else {
			return response()->json(['errno'=>1,'msg'=>'cannot found this collection']);
		}
	}

}
