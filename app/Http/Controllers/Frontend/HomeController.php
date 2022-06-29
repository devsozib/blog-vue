<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(){
        $posts = Post::with('category', 'user')->orderBy('id','DESC')->limit('5')->get();

        return response()->json(['posts' => $posts],200);
    }
}
