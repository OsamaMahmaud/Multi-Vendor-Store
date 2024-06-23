<?php

namespace App\Http\Controllers\Dashboard\Category;

use App\Models\Category;
use App\Http\Requests\Category\request_create;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //

      $filter=  $request->only(['search', 'status']);

      /*select `categories`.*,
      (select count(*) from `products` where `categories`.`id` = `products`.`category_id` and `store_id` = ?)
       as `products_number` from `categories` where `categories`.`deleted_at` is null*/

       $categories=Category::withCount('products as products_number')->filter($filter)->paginate(5);

        return view('dashboard.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = new Category();

        $parents=Category::all();
        return view('dashboard.category.create',compact('parents','category'));
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

        // return $request->all();
        $request->merge([
            'slug'=>Str::slug($request->name),
        ]);


        $data = $request->except('image');

        // dd($request->image);
        if($request->image)
        {
             $file_name=$this->saveImage($request->image,'uploads/category_images');

             $data['image']=  $file_name;

            //  dd($data);
        }


        $categories=Category::create($data);

        return redirect()->route('dashboard.categories.index')->with('success',__('site.added_successfully'));
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

        return view('dashboard.category.edit',compact('category','parents'));
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
        return redirect()->route('dashboard.categories.index')->with('success',__('site.updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category=Category::findOrFail($id);

        $image= $category->image;

        if( $image !='default.png' )
        {
           Storage::disk('uploads')->delete('/category_images/'.$image);
        }

        $category->delete();

        return redirect()->route('dashboard.categories.index')->with('success',__('site.deleted_successfully'));
    }
}
