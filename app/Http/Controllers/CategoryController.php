<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::with('posts')->orderBy('id','desc')->get();

        return response()->json([
            'categories'=>$categories
        ],200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
            'name'=>'required|min:5|max:90',
            'status'=>'required',
        ]);

        if($request->ajax()){
            $category = new Category();
            $category->name = $request->name;
            $category->slug = slugify($request->name);
            $category->status = $request->status;
            $category->save();

        }
        else{
            return back();
        }

        return response()->json([
           'message'=>'data store successfully',
        ]);



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    public function destroy(Category $category)
    {

    }
    public function deleteCategory($slug)
    {
        Category::where('slug',$slug)->delete();
        return response()->json([
            'message'=>'data Delete successfully',
        ]);
    }
    protected function categoryDetails($slug)
    {
           $categoryDetails=Category::where('slug',$slug)->first();
        return response()->json([
            'categoryDetail'=>$categoryDetails
        ],200);
//        return $slug;
    }
    public function categoryUpdate(Request  $request){

        $request->validate([
            'name'=>'required|min:5|max:90',
            'status'=>'required',
        ]);


        $categoryDetails=Category::where('id',$request->id)->first();
        $categoryDetails->name=$request->name;
        $categoryDetails->slug = slugify($request->name);
        $categoryDetails->status=$request->status;
        $categoryDetails->update();
        return response()->json([
            'message'=>'data Updated successfully',
        ]);
    }
    public function ItemDelete(Request  $request){
        $total=0;
        foreach ($request->slugs as $slug){
            Category::where('slug',$slug)->delete();
            $total++;
        }

        return response()->json([
            'total'=> $total,
            'message'=>'data deleted successfully',

        ]);
    }
    public function ItemActive(Request  $request){
        $total=0;
        foreach ($request->slugs as $slug){
             $category=Category::where('slug',$slug)->first();
             $category->status =1;
             $category->save();
             $total++;
        }

        return response()->json([
            'total'=> $total,
            'message'=>'status Updated successfully',

        ]);
    }
    public function IteminActive(Request  $request){
        $total=0;
        foreach ($request->slugs as $slug){
             $category=Category::where('slug',$slug)->first();
             $category->status =0;
             $category->save();
             $total++;
        }

        return response()->json([
            'total'=> $total,
            'message'=>'status Updated successfully',

        ]);
    }
}
