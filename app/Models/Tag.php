<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Product;


class Tag extends Model
{
    use HasFactory;

    protected $fillable=['name','slug'];

    public $timestamps = false;

   /**
    * The roles that belong to the Tag
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
   public function products(): BelongsToMany
   {
       return $this->belongsToMany(
        Product::class,
         'product_tag',
         'tag_id',
         'product_id',
         'id',
         'id'
        );
   }


}
