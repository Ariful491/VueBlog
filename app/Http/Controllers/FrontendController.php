<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function activeCategory(){
        $activeCategory = Category::where('status',1)->select('slug','name')->get();
        return response()->json([
            'activeCategories'=>$activeCategory
        ],200);
    }
    public function Posts($slug){
        $categoryId = Category::where('slug',$slug)->value('id');
        $posts = Post::with('user','category')->where('status','published')->where('category_id',$categoryId)->orderBy('id','DESC')->get();
            return response()->json([
                'posts'=>$posts
            ],200);
    }
    public function Allposts(){
//        $posts = Post::with('user','category')->where('status','published')->orderBy('id','DESC')->paginate(5);
//            return response()->json([
//                'posts'=>$posts
//            ],200);
        return Post::with('user','category')->where('status','published')->orderBy('id','DESC')->paginate(3);
    }
    public function postDetail($slug){
        $post = Post::with('user','category')->where('slug',$slug)->first();
        return response()->json([
            'post'=>$post
        ],200);
    }
}
