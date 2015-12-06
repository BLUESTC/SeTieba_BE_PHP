<?php namespace App\Http\Controllers\API;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;

//用户关注贴吧控制器
class FollowController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$user=Auth::user();
		if(!$user){
			return response()->json(['errno'=>2,'msg'=>'require authentication']);
		}
		$bas=$user->bas;
		return response()->json(['errno'=>0,'msg'=>'success','bas'=>$bas]);
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
		if(!$user){
			return response()->json(['errno'=>2,'msg'=>'require authentication']);
		}
		$ba_id=$request->input('ba_id');
		if(!$ba_id){
			return response()->json(['errno'=>4,'msg'=>'require ba_id']);
		}

		$user->bas()->attach($ba_id);

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

	public function destroy(Request $request)
	{

		$user=Auth::user();
		$ba_id=$request->input('ba_id');
		if(!$user){
			return response()->json(['errno'=>2,'msg'=>'require authentication']);
		}
		
		if(!$ba_id){
			return response()->json(['errno'=>1,'msg'=>'require ba_id']);
		}
		
		$user_id=$user->id;

		if (DB::table('ba_user')->where('user_id',$user_id)->where('ba_id',$ba_id)->get()){
			DB::table('ba_user')->where('user_id',$user_id)->where('ba_id',$ba_id)->delete();
			return response()->json(['errno'=>0,'msg'=>'success']);
		}
		else {
			return response()->json(['errno'=>1,'msg'=>'cannot found this collection']);
		}
	}

}
