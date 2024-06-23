<?php

namespace App\Http\Controllers\Dashboard\Product;

use App\Models\Tag;
use App\Models\Store;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Category\request_create;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $categories=Category::all();


        // two way is the best by using with

        // $products=Product::when($request->search , function($q)use($request)
        //   {
        //      $q->where('name','like','%'.$request->search.'%')->when($request->status,function($query)use($request){
        //          $query->where('status',$request->status);
        //       });
        //   })->paginate(5);

        $products=Product::with(['category','store'])->when($request->search , function($q)use($request)
          {
             $q->where('name','like','%'.$request->search.'%')->when($request->status,function($query)use($request){
                 $query->where('status',$request->status);
              });
          })->paginate(5);

        // return $category=  $products->pluck('category')->filter()->pluck('name');

        return view('dashboard.Products.index',compact('products','categories'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $product = new Product();

        $stores=Store::all();

        $categories=Category::all();


        return view('dashboard.products.create',compact('product','stores','categories'));
    }

    function saveImage($photo,$folder)
    {
      $file_extension = $photo ->getClientOriginalExtension();
      $file_name =time().'.'.$file_extension;
      $file_path =$folder;
      $photo->move($file_path,$file_name);
      return $file_name;
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(request_create $request)
    {
        // // return $request->all();
        $request->merge([
            'slug'=>Str::slug($request->name),
        ]);

        $data = $request->except('image','');

        if($request->image)
        {
             $file_name=$this->saveImage($request->image,'uploads/product_images');

             $data['image']=  $file_name;
        }

        $product = Product::create($data);

        // return $request->tags;

    $tags =$request->post('tags');

    $tag_ids = [];

    $saved_tags = Tag::all();

    foreach ($tags as $item) {
        
        $slug = Str::slug($item);
        $tag = $saved_tags->where('slug', $slug)->first();
        if (!$tag) {
            $tag = Tag::create([
                'name' => $item,
                'slug' => $slug,
            ]);
        }
        $tag_ids[] = $tag->id;
    }

    $product->tags()->sync($tag_ids); // مزامنة العلامات مع المنتج

        // return $request->all();
        return redirect()->route('dashboard.products.index')->with('success',__('site.added_successfully'));

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category=Category::findOrFail($id);

        $parents=Category::where('id','<>',$id)->where(function($query)use($id){
            $query->where('parent_id',$id)->orWhere('parent_id',null);
        })->get();

        return view('dashboard.products.edit',compact('category','parents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(request_create $request, string $id,)
    {
        $categories=Category::findOrFail($id);

        $old_image=$request->image;

        $data= $request->except('image');

        if($request->image)
        {
             $file_name=$this->saveImage($request->image,'uploads/category_images');

             $data['image']=  $file_name;

            //  dd($data);
        }

        $categories->update($data);

        if($old_image && isset($data['image']))
        {
           Storage::disk('uploads')->delete($old_image);
        }
        return redirect()->route('dashboard.products.index')->with('success',__('site.updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product=Product::findOrFail($id);

        $image= $product->image;

        if( $image !='default.png' )
        {
           Storage::disk('uploads')->delete('/product_images/'.$image);
        }

        $product->delete();

        return redirect()->route('dashboard.products.index')->with('success',__('site.deleted_successfully'));
    }
}
