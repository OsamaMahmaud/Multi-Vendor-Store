<?php

namespace App\Http\Controllers\Front;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Cart\CartRepository;
use App\Repositories\CartModelRepository\CartModelRepository;

class CartController extends Controller
{
    protected $cart;

    public function __construct(CartRepository $cart)
    {
        $this->cart = $cart;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $total= $this->cart->total();
        $Cart_Subtotal=$this->cart->Cart_Subtotal();
        $sub_total=$this->cart->Sub_total();
        $cart=  $this->cart->get();

        return view('front.cart',compact('cart','total','sub_total','Cart_Subtotal'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'int', 'exists:products,id'],
            'quantity' => ['nullable', 'int', 'min:1'],
        ]);

        $product=Product::findOrFail($request->product_id);

        $this->cart->add($product,$request->post('quantity'));

        return redirect()->route('cart.index')->with('success',__('site.added_successfully'));

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,   $id)
    {
        $request->validate([
            'quantity' => ['required', 'int', 'min:1'],
        ]);

        $this->cart->update($id,$request->post('quantity'));

        return response()->json(['success' => true]);

        // return redirect()->route('cart.index')->with('success',__('site.updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->cart->delete($id);

        return redirect()->route('cart.index')->with('success',__('site.deleted_successfully'));
    }

}
