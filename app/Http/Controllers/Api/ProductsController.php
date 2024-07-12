<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;

class ProductsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index','show']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products= Product::filter($request->query())
        ->with('category:id,name', 'store:id,name', 'tags:id,name')
        ->paginate(15);

        return  ProductResource::collection($products);


        // return Product::filter($request->query())
        //     ->with('category:id,name', 'store:id,name', 'tags:id,name')
        //     ->paginate(15);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'compare_price' => 'nullable|numeric|gt:price',
            'description' => 'nullable|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'status' => 'in:active,archive'

        ]);
        $product = Product::create($request->all());
        return response()->json($product, 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
         return new ProductResource($product);

        // when get relation with single product using load  not use with //load using with object not collection
        // return $product->load('category:id,name', 'store:id,name', 'tags:id,name');

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'price' => 'sometimes|required|numeric|min:0',
            'compare_price' => 'nullable|numeric|gt:price',
            'description' => 'nullable|string|max:255',
            'category_id' => 'sometimes|required|exists:categories,id',
            'status' => 'in:active,archive'

        ]);
        $product->update($request->all());
        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //destroy product
        Product::destroy($id);
        //  return response()->json(null, 204); //null ->no contant
        return [
            'message' => 'Product deleted successfully',
        ];

    }
}
