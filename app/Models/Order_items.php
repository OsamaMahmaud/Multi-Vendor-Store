<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Order_items extends Pivot
{
    use HasFactory;

    protected $table='order_items';

    protected $fillable=['order_id', 'product_id', 'product_name', 'price', 'quantity', 'options'];
    public $incrementing = true;

    public $timestamps=false;

    //relations

     public function order()
     {
        return $this->belongsTo(Order::class);
     }

     public function product()
     {
        return $this->belongsTo(Product::class);
     }




}
