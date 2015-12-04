<?php namespace App\Http\Controllers\API;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;
use App\Ba;

class BaController extends Controller {

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
		$name=$request->input('name');
		$desc_text=$request->input('desc_text');
		
		if(!Auth::check()){
			return response()->json(['errno'=>2,'msg'=>'require authentication']);
		}
		if((!$name)||(!$desc_text)){
			return response()->json(['errno'=>1,'msg'=>'require name and desc_text']);
		}

		$ba = new Ba;
		$ba->name=$name;
		$ba->desc_text=$desc_text;
		$ba->pics=$request->input('pics');
		$ba->save();

		return response()->json(['errno'=>0,'msg'=>'success','ba'=>$ba]);
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
		//
	}

}
