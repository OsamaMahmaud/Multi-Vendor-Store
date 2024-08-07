<?php

namespace App\Models;

use App\Models\Store;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\Scopes\StoreScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
     protected $fillable =['id', 'store_id', 'category_id', 'name', 'slug', 'description', 'image', 'price', 'compare_price', 'options', 'rating', 'featured', 'status'];


     protected $appends = ['image_path'];

     protected $hidden=['created_at','updated_at','deleted_at','image'];


     //$product->image_url
     public function getImagePathAttribute()
     {
         if(!$this->image)
         {
            return asset('uploads/product_images/default.png');
         }
         if(Str::startsWith($this->image, ['http://', 'https://']))
         {
             return $this->image;
         }
         return asset('uploads/product_images/'. $this->image);
     }

     public function getSalePercentAttribute()
     {
        if(!$this->compare_price)
        {
            return 0;
        }

        return round(100 - (100 * $this->price / $this->compare_price), 0);
     }

     //globalScope
     protected static function booted()
    {
        static::addGlobalScope('store',new StoreScope());
        static::creating(function(Product $product){
             $product->slug = Str::slug($product->name);
        });
        
    }


    //local scope

    public function scopeActive(Builder $builder){

      $builder->where('status','active');
    }


    //relation
    public function category(): BelongsTo
    {
      return $this->belongsTo(Category::class, 'category_id', 'id')->withDefault();
    }

    public function store(): BelongsTo
    {
      return $this->belongsTo(Store::class, 'store_id', 'id');
    }

    //many to many
    public function tags()
    {
        return $this->belongsToMany(
            Tag::class,     // Related Model
            'product_tag',  // Pivot table name
            'product_id',   // FK in pivot table for the current model
            'tag_id',       // FK in pivot table for the related model
            'id',           // PK current model
            'id'            // PK related model
        );
    }

    //make scop filter
    public function scopeFilter(Builder $builder, $filters)
    {
        //array_merge withe filter
        $options = array_merge([
            'category_id' => null,
            'store_id' => null,
            'tag_id'=>null,
            'status'=>'active'],$filters);

        //category_id    
        $builder->when($options['category_id'],function($builder,$value){
            return $builder->where('category_id',$value);
        });
        //store_id
        $builder->when($options['store_id'],function($builder,$value){
            return $builder->where('store_id',$value);
            });
         //tag_id
         $builder->when($options['tag_id'],function($builder,$value){
            return $builder->whereExists(function($query) use ($value){
                    $query->select (1)  //select row 
                    ->from('product_tag')
                    ->whereColumn('product_tag.product_id','products.id')
                    ->where('product_tag.tag_id',$value);
                });
            });

         //status
         $builder->when($options['status'],function($builder,$status){
            return $builder->where('status',$status);
            });
            
          

    }



}
