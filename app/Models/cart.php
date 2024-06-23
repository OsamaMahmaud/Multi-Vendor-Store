<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Observers\CartObserver;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class cart extends Model
{
    use HasFactory;

    public $incrementing=false;

    protected $fillable=['cookie_id', 'user_id', 'product_id', 'quantity', 'options'];



    //events {observers}

    public static function booted(){


        static::observe(CartObserver::class);

        static::addGlobalScope('cooke_id',function(Builder $builder){
            $builder->where('cookie_id',cart::getCookieId());
            // $builder->where('cookie_id',$this->getCookieId()); //cant use this in function static i convert the methods to static
        });


        // static::creating(function(cart  $cart){

        //     $cart->id=Str::uuid();

        // });
    }


    public static function getCookieId(){

        $cookie_id=Cookie::get('cart_id');

        if(!$cookie_id)
        {
            $cookie_id=Str::uuid();
            Cookie::queue('cart_id',$cookie_id,30*24*60);
        }
        return $cookie_id;
    }



    //relations

    /**
     * Get the user that owns the cart
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }


}
