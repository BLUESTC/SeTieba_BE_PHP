<?php namespace App\Http\Controllers\API;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use AuthenticatesAndRegistersUsers;
use Auth;
use DB;


class AuthController extends Controller {

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
    public function store()
    {
        //
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

    public function login(Request $request){
        $userName=$request->input('username');
        $password=$request->input('password');
        if(Auth::attempt(['email' => $userName, 'password' => $password])){
            $user=Auth::user();
            return response()->json(['errno'=>0,'msg'=>'login success','user'=>$user]);
        }else{
            return response()->json(['errno'=>1,'msg'=>'wrong username or password']);
        }
    }
    public function logout(Request $request){
        $userName=$request->input('username');
        Auth::logout();
    }




    public function register(Request $request){
        $userName=$request->input('username');
        $password=$request->input('password');
        $email=$request->input('email');
        $array=DB::table('users')->where('email',$email)->get(); 
        if ($array) return response()->json(['errno'=> 1,'msg'=>"sorry,your email has been registered"]);
        else {
            // DB::table('users')->increment('','',array('name'=>$userName,'email'=>$email,'password'=>$password));
            DB::insert('insert into users (name,email,password) values(?,?,?)',[$userName,$email,$password]);
            return response()->json(['errno'=>0,'msg'=> "thanks for register in:".$userName]);

        }

    }



}
