<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Store extends Model
{
    use HasFactory;


    protected $fillable=['id', 'name', 'slug', 'description', 'logo_image', 'cover_image', 'status'];


     //relation one to many
     public function products(): HasMany
     {
         return $this->hasMany(Product::class, 'store_id', 'id');
     }
}
