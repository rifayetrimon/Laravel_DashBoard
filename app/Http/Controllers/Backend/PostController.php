<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;


class PostController extends Controller{
    /** 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $posts = Post::orderBy('id', 'desc')->get();
        return view('backend.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $categories = Category::select('id', 'name')->get(); 
        return view('backend.post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $image = $request->file("thumbnail");
        $request->validate([
            'title' => "required",
            'category' => "required | integer",
            'body'  => "max:2500",
            'image' => "image|mimes:jpg,png,jpeg | max:1000"
        ]);

        $image_name = null;
        
        if($image->isValid()){
            $image_name = Str::slug(strtolower($request->title)) . '.' .$image->getClientOriginalExtension();
            Image::make($image)->crop(870, 550)->save(public_path('storage/uploads/posts/') . $image_name, 90);
        }

        $insert              =new post();
        $insert->title       = $request->title;
        $insert->body        = $request->body;
        $insert->category_id = $request->category;
        $insert->user_id     = Auth::user()->id;
        $insert->slug        = str::slug($request->title);
        $insert->status      = $request->status;
        $insert->thumbnail   = $image_name;
        $insert->save();

        return redirect(route('post.index'))->with('message', 'Post Successfully Inserted');

    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post){
        $posts = post::where('id', 'null')->get(); 
        return view('backend.post.edit', compact('posts','post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $image = $request->file("thumbnail");
        $request->validate([
            'title' => "required",
            'category' => "required | integer",
            'body'  => "max:2500",
            'image' => "image|mimes:jpg,png,jpeg | max:1000"
        ]);
        
        if($image && $image->isValid()){

            $imagePath = public_path('storage/uploads/posts/'.  $post->image);
        
            if(file_exists($imagePath)){
                unlink($imagePath);
            }

            $image_name = Str::slug(strtolower($request->name)). '-'. time() . '.' . $image->getClientOriginalExtension(); 
            
            image::make($image)->crop(150, 150)->save(public_path('storage/uploads/posts/') . $image_name, 90);
        }else{
            $image_name = $post->image;
        }

        $post->name        = $request->name;
        $post->parent_id   = $request->parent_id;
        $post->image       = $image_name;
        $post->save();

        return redirect(route('post.index'))->with('message', 'Category Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
