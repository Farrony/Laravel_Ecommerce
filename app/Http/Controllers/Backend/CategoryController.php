<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('name','asc')->get();
        return view('admin.pages.categories.manage',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $primary_category = Category::orderBy('name','asc')->where('parent_id', 0)->get();
        return view('admin.pages.categories.create', compact('primary_category'));
        
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
            'name' => 'required|max:255',
        ],
        [
            'name.required' => 'This :attribute field is required!',
        ]);

        $category = new Category();
        $category->name = $request->name; 
        $category->desc = $request->desc; 
        $category->parent_id = $request->parent_id; 

        if ( !empty($request->image) ){
            $image =$request->file('image');
            $img = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('backend/img/categories/'.$img);
            ImageManagerStatic::make($image)->save($location);
            $category->image =$img;
        }
        $category->save();
        return redirect()->route('category.manage');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Backend\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Backend\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $primary_category = Category::orderBy('name','asc')->where('parent_id', 0)->get();
        $category = Category::find($id);
        if( !is_null( $category ) ){
            return view('admin.pages.categories.edit',compact('category','primary_category'));
        }
        else {
            return route('category.manage');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Backend\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
        ],
        [
            'name.required' => 'This :attribute field is required!',
        ]);

        $category =Category::find($id);
        $category->name = $request->name; 
        $category->desc = $request->desc; 
        $category->parent_id = $request->parent_id; 

        if ( $request->image )
        {
            // Delete existing image 
            if( File::exists('backend/img/categories/' . $category->image) ){
                File::delete('backend/img/categories/' . $category->image);
            }
            $image =$request->file('image');
            $img = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('backend/img/categories/'.$img);
            ImageManagerStatic::make($image)->save($location);
            $category->image =$img;
        }
        $category->save();
        return redirect()->route('category.manage');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Backend\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        if( !is_null( $category ) ){
            // Delete existing image 
            if( File::exists('backend/img/categories/' . $category->image) ){
                File::delete('backend/img/categories/' . $category->image);
            }
            $category->delete();
            return redirect()->route('category.manage');
        }
        else {
            return redirect()->route('category.manage');
        }
    }
}
