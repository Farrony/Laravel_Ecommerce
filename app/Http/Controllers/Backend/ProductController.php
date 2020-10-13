<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Product;
use App\Models\Backend\Category;
use App\Models\Backend\Brand;
use App\Models\Backend\ProductImage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic;

class ProductController extends Controller {
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function index() {
        $products = Product::orderBy( 'id', 'desc' )->get();
        return view( 'admin.pages.products.manage', compact( 'products' ) );
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function create() {
        return view( 'admin.pages.products.create' );
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */

    public function store( Request $request ) {
        $request->validate( [
            'title' => 'required|max:255',
            'description' => 'required|max:1000',
            'brand_id' => 'required|max:255',
            'category_id' => 'required',
            'price' => 'required|numeric'
        ] );

        $product = new Product();
        $product->title         = $request->title;
        $product->description   = $request->description;
        $product->slug          = Str::slug($request->title);
        $product->brand_id      = $request->brand_id;
        $product->category_id   = $request->category_id;
        $product->offer_price   = $request->offer_price;
        $product->price         = $request->price;
        $product->quantity      = $request->quantity;
        $product->status        = $request->status;
        $product->save();

        if( count($request->p_image) >0 ){
            foreach( $request->p_image as $image ){
                $img = rand(0,99999) . '.' . $image->getClientOriginalExtension();
                $location = public_path('backend/img/products/'.$img);
                ImageManagerStatic::make($image)->save($location);

                $p_image = new ProductImage();
                $p_image -> product_id = $product->id; //product id collect and store in products_image table

                $p_image->image = $img;
                $p_image->save();
            }
        }
        return redirect()->route('product.manage');
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function show( $id ) {
        //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function edit( $id ) {
        //
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function update( Request $request, $id ) {
        //
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function destroy( $id ) {
        //
    }
}
