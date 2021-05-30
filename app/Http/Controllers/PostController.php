<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;

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

        $request->validate([
            'title'=>'required|min:5|max:90',
            'description'=>'required',
            'category_id'=>'required',
            'status'=>'required',
        ]);
        $file = explode(';',$request->thumbnail);
        $file = explode('/',$file[0]);
        $file_Extension  = end($file);
        $slug = slugify($request->title);
        $file_name = $slug.'.'.$file_Extension;

        $post  =new Post();
        $post->title = $request->title;
        $post->slug =$slug;
        $post->description =$request->description;
        $post->category_id =$request->category_id;
        $post->status =$request->status;
        $post->thumbnail ='uploads/posts/'.$file_name;
        $post->user_id = Auth::id();
        $post->save();
         Image::make($request->thumbnail)->save(public_path('uploads/posts/').$file_name);

        return response()->json([
            'message'=>'Added Successfully '
        ]);

    }

    public function destroy($slug)
    {
           $post = Post::where('slug',$slug)->first();
           $filename = $post->thumbnail;
          $success =$post->delete();
           if($success){
               if(file_exists(public_path($filename))){
                   unlink(public_path($filename));

               }

           }else{
               return response()->json([
                   'message'=>'error Successfully '
               ]);
           }
        return response()->json([
            'message'=>'Deleted Successfully '
        ]);
    }


    public function postDetails($slug)
    {
        $post  = Post::where('slug',$slug)->first();
        return response()->json([
            'post'=>$post
        ]);

    }
    public function postUpdate(Request $request)
    {
        $request->validate([
            'title'=>'required|min:5|max:90',
            'description'=>'required',
            'category_id'=>'required',
            'status'=>'required',
        ]);


        $slug = slugify($request->title);
        $post  = Post::find($request->id);
        if($request->thumbnail != $post->thumbnail ){
            if(file_exists(public_path($post->thumbnail))){
                unlink(public_path($post->thumbnail));

            }
            $file = explode(';',$request->thumbnail);
            $file = explode('/',$file[0]);
            $file_Extension  = end($file);
            $file_name = $slug.'.'.$file_Extension;
        }
        $post->title = $request->title;
        $post->slug =$slug;
        $post->description =$request->description;
        $post->category_id =$request->category_id;
        $post->status =$request->status;
        $filename = $post->thumbnail;

        if($request->thumbnail != $post->thumbnail){
            if(file_exists(public_path($filename))){
                unlink(public_path($filename));

            }
            $post->thumbnail ='uploads/posts/'.$file_name;
            Image::make($request->thumbnail)->save(public_path('uploads/posts/').$file_name);
        }


        $post->user_id = Auth::id();
        $post->update();

        return response()->json([
            'message'=>'Update Successfully '
        ]);

    }
}
