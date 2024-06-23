<?php

namespace App\Listeners;

use Throwable;
use App\Models\Order;
use App\Events\OrderCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class DeductProductQuantity
{
    /**
     * Create the event listener.
     */
    // public $order;
    public function __construct(Order $order)
    {
        // $this->order=$order;
    }

    /**
     * Handle the event.
     */
    // public function handle($order): void
    // {
    //     // dd($order->products );
    //     foreach ($order->products as $product) {
    //         // dd($product->pivot->quantity);
    //         $product->decrement('quantity',$product->pivot->quantity);
    //         // $product->quantity -= $product->pivot->quantity;
    //         // $product->save();
    //         }
    // }

    public function handle(OrderCreated $event)
    {
        $order = $event->order;
        
        // UPDATE products SET quantity = quantity - 1
        try {
            foreach ($order->products as $product) {
                $product->decrement('quantity', $product->pivot->quantity);
                
                // Product::where('id', '=', $item->product_id)
                //     ->update([
                //         'quantity' => DB::raw("quantity - {$item->quantity}")
                //     ]);
            }
        } catch (Throwable $e) {
              
        }
    }
}
