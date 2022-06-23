<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('category', 'user')->get();

        return response()->json(['posts' => $posts],200);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $request->validate([
            "title" => 'required',
            "status" => 'required',

        ]);

        Post::create([
            "category_id"=>$request->category_id,
            "user_id"=>Auth()->user()->id,
            "title" =>$request->title,
            "content" =>$request->content,
            "thumbnail" =>"thumbnail",
            "status" =>$request->status,

        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::where('id', $id)->first();

        $post->delete();
    }

    public function removeItems(Request $request){
        $serial = 0;
        foreach($request->data as $ids){
            $postIds = Post::find($ids);
            $postIds->delete();
            $serial++;
        }

        $success = $serial > 0 ;
        return response()->json(['success' => $success, 'total'=>$serial],200);
    }

    public function changeStatus(Request $request){
        $serial = 0;
        foreach($request->data as $ids){
            $post         = Post::find($ids);
            $post->status = $request->status;
            $post->save();
            $serial++;
        }

        $success = $serial > 0 ;
        return response()->json(['success' => $success, 'total'=>$serial],200);
    }

}
