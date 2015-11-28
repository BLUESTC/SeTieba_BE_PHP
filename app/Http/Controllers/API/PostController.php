<?php namespace App\Http\Controllers\API;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Auth;
use App\Post;

class PostController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $limit=$request->input("limit");
        $skip=$request->input("skip");
        if(Auth::check()){
            $limit=null?20:$limit;
            $skip=null?0:$skip;
        }else{
            $limit=10;
            $skip=0;
        }
        $hotPosts=Post::orderBy("last_comment_at","desc")->skip($skip)->take($limit)->get();
        return response()->json(["errno"=>0,"msg"=>"succes","hotSum"=>$hotPosts->count(),"posts"=>$hotPosts]);
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
            return response()->json(["errno"=>2,"msg"=>"require authentication"]);

        }
        $title=$request->input("title");
        $content=$request->input("content");
        $subject_id=$request->input("subject_id");
        $ba_id=$request->input("ba_id");
        if((!$title)||(!$content)||(!$subject_id)||(!$ba_id)){
            return response()->json(["errno"=>3,"msg"=>"need title ,content ,subject_id,ba_id"]);
        }

        $post=new Post;
        $post->uid=Auth::user()->id;
        $post->title=$title;
        $post->content=$content;
        $post->pics=$request->input("pics");
        $post->subject_id=$subject_id;
        $post->ba_id=$ba_id;
        $post->at_users=$request->input("at_users");
        $post->last_comment_id=$post->uid;
        //$post->last_comment_at=time();
        $post->save();
        return response()->json(["errno"=>1,"msg"=>"success","pid"=>$post->pid]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        if(!(Auth::check())){
            return response()->json(["errno"=>2,"msg"=>"require authentication"]);
        }
        $post=Post::find($id);
        if($post){
            return response()->json(["errno"=>0,"msg"=>"success","post"=>$post]);
        }else{
            return response()->json(["errno"=>1,"msg"=>"post not fount"]);
        }
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
