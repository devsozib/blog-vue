<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('category', 'user')->orderBy('id','DESC')->where('status',"published")->get();

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
        $success = false;



        $request->validate([
            "title" => 'required',
            "status" => 'required',

        ]);

        $imageExtension = explode(';', $request->thumbnail);
        $imageExtension = explode('/', $imageExtension[0]);
        $file_extension = end($imageExtension);

        $slug = Str::slug($request->title);
        $fileName =$slug.'.'.$file_extension;

        $success = Post::create([
            "category_id"=>$request->category_id,
            "user_id"=>Auth()->user()->id,
            "title" =>$request->title,
            "content" =>$request->content,
            "thumbnail" =>$fileName,
            "status" =>$request->status,

        ]);

        if($success){

            $img = Image::make($request->thumbnail)->resize(500, 250)->save(public_path('uploads/posts/') . $fileName);
           }

        return response()->json(['success'=>$success],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::where('id', $id)->first();
        return response()->json(['post' => $post],200);
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
    public function update(Request $request)
    {


        $request->validate([
            "title" => 'required',
            "status" => 'required',

        ]);


        $post = Post::find($request->id);

            $post->category_id = $request->category_id;
            $post->title =$request->title;
            $post->content =$request->content;
            $post->status =$request->status;
            if($request->thumbnail != $post->thumbnail){
                $imageExtension = explode(';', $request->thumbnail);
                $imageExtension = explode('/', $imageExtension[0]);
                $file_extension = end($imageExtension);

                $slug = Str::slug($request->title);
                $fileName =$slug.'.'.$file_extension;
                $post->thumbnail = $fileName;
                Image::make($request->thumbnail)->resize(500, 250)->save(public_path('uploads/posts/') . $fileName);
            }
           $success =  $post->save();
            return response()->json(['success'=>$success],200);
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
        $fileName = $post->thumbnail;
        if($post->delete()){
           if(file_exists(public_path('uploads/posts/'.$fileName))){
              unlink(public_path('uploads/posts/'.$fileName));
           }
        }
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

    public function details($id){
        $post = Post::with('category', 'user')->where('id', $id)->first();
        return response()->json(['post' => $post],200);
    }

    public function getPostByCategory($slug){
           $category_id = Category::where('slug', $slug)->first();

           $posts = Post::with('category', 'user')
           ->orderBy('id', 'DESC')
           ->where('category_id', $category_id->id)
           ->where('status', 'published')
           ->get();

           return response()->json(['posts' => $posts],200);
    }

}
