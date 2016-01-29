<?php namespace App\Http\Controllers\API;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Cache;
use AuthenticatesAndRegistersUsers;
use Auth;
use App\User;


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
        if (Auth::check()){return "login already";}
        $userName=$request->input('username');
        $password=$request->input('password');
        $userAgent=($request->input('useragent'))?$request->input('useragent'):'webSite';
        if(Auth::attempt(['email' => $userName, 'password' => $password])){
            $user=Auth::user();
            Cache::forever($user['id'],$userAgent);
            return response()->json(['errno'=>0,'msg'=>'login success','user'=>$user]);
        }else{
            return response()->json(['errno'=>1,'msg'=>'wrong username or password']);
        }
    }

    public function logout(Request $request){
        $userName=$request->input('username');
        if (!Auth::check()){return response()->json(['errno'=>1,'msg'=>'you should login first']);}//检查登陆状态
        Cache::forget(Auth::user()['id']);//从登陆缓存中消除
        Auth::logout();
        return response()->json(['errno'=>0,'msg'=>'logout success']);
    }

    public function register(Request $request){
        $userName=$request->input('username');
        $password=$request->input('password');
        $email=$request->input('email');

        if((!$userName)||(!$password)||(!$email)){
            return response()->json(['errno'=> 2,'msg'=>'username,password,email are required']);
        }else if(User::where('email',$email)->get()->count()!==0){
            return response()->json(['errno'=> 1,'msg'=>'sorry,your email has been registered']);
        }else{
            $user=new User;
            $user->name=$userName;
            $user->password=bcrypt($password);
            $user->email=$email;
			$user->save();

            return response()->json(['errno'=>0,'msg'=> 'thanks for register in:'.$userName]);
        }
    }


}
