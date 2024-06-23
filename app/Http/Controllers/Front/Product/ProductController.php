<?php

namespace App\Http\Controllers\Front\Product;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    //

    public function index(Request $request){

        
        $products=Product::
        with('category')
        ->when($request->search,function($q)use($request)
          {
             $q->where('name','like','%'.$request->search.'%')->when($request->status,function($query)use($request){
                 $query->where('status',$request->status); });
          })
        ->latest()
        ->paginate(12);

        $categories=Category::all();




        return view('front.product.all',compact('products','categories'));
    }


    public function show(Product $product)
    {
        // return Product::with('category')->get();
        if ($product->status != 'active') {
            abort(404);
        }

        return view('front.product.show',compact('product'));
    }


















}
