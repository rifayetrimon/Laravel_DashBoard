<?php


namespace App\Http\Controllers\Backend;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use PHPUnit\Framework\MockObject\Stub\ReturnStub;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index(){
    //     $categories = category::select('id', 'name', 'image')->where("status", true)->get();
    //     return view("backend.category.index", compact('categories'));
    // }
    public function index(){
        $categories = category::where("deleted_at", null)->get();
        $trashCategories = category::onlyTrashed()->get();

        return view("backend.category.index", compact('categories', 'trashCategories'));
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
    public function store(Request $request){

        $category_image = $request->file("image");
        
        $request->validate([
            "name"       => "required",
            "parent-id"  =>"integer",
            "description"=>"max:255",
            "image"      =>"image|mimes:jpg,png,jpeg|max:1000",
        ]);
        
        if($category_image->isValid()){
            $image_name = Str::slug(strtolower($request->name)). '-'. time() . '.' . $category_image->getClientOriginalExtension(); 
            
            image::make($category_image)->crop(150, 150)->save(public_path('storage/uploads/categories/') . $image_name, 90);
        }


        $insert = new Category();
        $insert->name        = $request->name;
        $insert->slug        = Str::slug($request->name);
        $insert->parent_id   = $request->parent_id;
        $insert->description = $request->description;
        $insert->image       = $image_name;
        $insert->save();

        return back()->with('message', 'Category Insert Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category){
        return view('backend.category.show',compact('category'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category) {
        $categories = category::where("deleted_at", null)->get();
        return view('backend.category.edit', compact('categories','category'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category){
        $category_image = $request->file("image");
        
        $request->validate([
            "name"       => "required",
            "parent-id"  =>"integer",
            "description"=>"max:255",
            "image"      =>"image|mimes:jpg,png,jpeg|max:1000",
        ]);
        
        if($category_image && $category_image->isValid()){

            $imagePath = public_path('storage/uploads/categories/'.  $category->image);
        
            if(file_exists($imagePath)){
                unlink($imagePath);
            }

            $image_name = Str::slug(strtolower($request->name)). '-'. time() . '.' . $category_image->getClientOriginalExtension(); 
            
            image::make($category_image)->crop(150, 150)->save(public_path('storage/uploads/categories/') . $image_name, 90);
        }else{
            $image_name = $category->image;
        }

        $category->name        = $request->name;
        $category->parent_id   = $request->parent_id;
        $category->description = $request->description;
        $category->image       = $image_name;
        $category->save();

        return redirect(route('category.index'))->with('message', 'Category Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category){
        $category->delete();
        return back()->with('message', 'Category Delete Successfully');
    }

    //restore category

    public function restoreCategory($id){
        $data = category::onlyTrashed()->find($id);
        $data->restore();
        return back()->with('message', 'Category Restore Successfully');
    }
    
    //hard delete category

    public function hardDelete($id){
        $data = category::onlyTrashed()->find($id);
        $imagePath = public_path('storage/uploads/categories/'.  $data->image);
        
        if(file_exists($imagePath)){
            unlink($imagePath);
        }
        $data->forceDelete();
        return back()->with('message', 'Category Delete Successfully');
    }
}

