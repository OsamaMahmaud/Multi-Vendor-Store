<?php

namespace App\Http\Controllers\Front\Orders;

use Throwable;
use App\Models\User;
use App\Models\Order;
use App\Models\Order_items;
use App\Events\OrderCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Intl\Countries;
use App\Repositories\Cart\CartRepository;
use Illuminate\Support\Facades\Notification;
use Mockery\Exception\InvalidOrderException;
use App\Notifications\OrderCreatedNotification;

class CheckoutControllers extends Controller
{
    public function create(CartRepository $cart)
    {
        if ($cart->get()->count() == 0) {
            // throw new InvalidOrderException('Cart is empty');
            return view('front.error');
        }
        $countries = Countries::getNames();
        return view('front.checkout', compact('cart', 'countries'));
    }



    public function store(Request $request, CartRepository $cart)
    {
        $request->validate([
            'addr.billing.first_name' => ['required', 'string', 'max:255'],
            'addr.billing.last_name' => ['required', 'string', 'max:255'],
            'addr.billing.email' => ['required', 'string', 'max:255'],
            'addr.billing.phone_number' => ['required', 'string', 'max:255'],
            'addr.billing.city' => ['required', 'string', 'max:255'],
        ]);

        $items = $cart->get()->groupBy('product.store_id')->all();

        DB::beginTransaction();
        try {
            foreach ($items as $store_id => $cart_items) {

                $order = Order::create([
                    'store_id' => $store_id,
                    'user_id' => Auth::id(),
                    'payment_method' => 'cod',
                ]);

                foreach ($cart_items as $item) {
                    Order_items::create([
                        'order_id' => $order->id,
                        'product_id' => $item->product_id,
                        'product_name' => $item->product->name,
                        'price' => $item->product->price,
                        'quantity' => $item->quantity,
                    ]);
                }

                foreach ($request->post('addr') as $type => $address) {
                    $address['type'] = $type;
                    $order->addresses()->create($address);
                }
            }

            // $cart->empty();

       

            DB::commit();

            $user=User::where('store_id',$order->store_id)->first();
       
            if($user){
                $user->notify(new OrderCreatedNotification($order));
                }

            // event('order.create',$order);

            //event('order.created', $order, Auth::user());
            
            // event(new OrderCreated($order));

           

        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }

        // return redirect()->route('home');
    }

}
