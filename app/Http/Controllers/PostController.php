<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $posts= Post::with('category','user')->orderBy('id','desc')->get();
        return response()->json([
           'posts'=>$posts
        ]);
    }


    public function store(Request $request)
    {

    }

    public function destroy($slug)
    {
           Post::where('slug',$slug)->delete();
           return response()->json([
              'message'=>'Deleted Successfully '
           ]);
    }


    public function postDetails(Post $post)
    {

    }
    public function postUpdate(Post $post)
    {

    }
}
