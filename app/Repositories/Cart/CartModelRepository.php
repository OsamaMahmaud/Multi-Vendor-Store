<?php
namespace App\Repositories\Cart;

use App\Models\cart;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use App\Repositories\Cart\CartRepository;

class CartModelRepository implements CartRepository
{


    protected $items;

    public function __construct()
    {
        $this->items = collect([]);
    }

    public function get(){

        if(!$this->items->count())
        {
            $this->items= cart::with('product')->get();
        }
        return $this->items;

    }

    public function add(Product $product , $quantity=1){

        $cart = cart::where('product_id',$product->id)->first();

        if(!$cart){
            return cart::create([

                    // 'cookie_id'=>$this->getCookieId(),
                    'user_id'=>Auth::id(),
                    'product_id'=>$product->id,
                    'quantity'=>$quantity,
                ]);
        }
    // else{
    //     $cart->quantity += $quantity;
    //     $cart->save();
    //     return $cart;
    //     }

        return $cart->increment('quantity',$quantity);
    }

    public function update($id,$quantity){

       $product= cart::where('id',$id)->update([

          'quantity'=>$quantity,
       ]);
    }

    public function delete($id){

        $product= cart::where('id',$id)->delete();
    }

    public function empty(){
        // cart::where('cookie_id',$this->getCookieId())->destroy();
        cart::query()->delete();
    }

    public function total():float{

        return $this->get()->sum(function($item){
             return $item->product->price * $item->quantity;
        });

        // return (float)cart::join('products','products.id','carts.product_id')->selectRaw('SUM(products.price * carts.quantity) as total')->value('total');
    }

    public function Sub_total():float{

        return $this->get()->sum(function($item){
             return$item->product->compare_price;
        });

        // return (float)cart::join('products','products.id','carts.product_id')->selectRaw('SUM(products.price * carts.quantity) as total')->value('total');
    }

    public function Cart_Subtotal():float{

       return  $this->total() + $this->Sub_total();

    }


}
