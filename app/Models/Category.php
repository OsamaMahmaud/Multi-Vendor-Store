<?php

namespace App\Models;
use App\Models\Product;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['name', 'slug', 'description', 'image', 'status', 'parent_id'];

    protected $appends = ['image_path'];

     protected $hidden = ['created_at', 'updated_at'];

    public function parent(){
        return $this->belongsTo(Category::class, 'parent_id','id')->withDefault([
            'name' => '-'
        ]);
    }

    //image_path
    public function getImagePathAttribute()
    {
        if($this->image)
        {
            return asset('uploads/category_images/'. $this->image);
        }
        else
        {
            return asset('uploads/category_images/default.png');
        }
    }


    //validation
    public static function rules($id = 0)
    {
        return [
            'name' => [
                'required',
                'string',
                'min:3',
                'max:255',
                // "unique:categories,name,$id",
                Rule::unique('categories', 'name')->ignore($id),

            ],
            'parent_id' => [
                'nullable', 'int', 'exists:categories,id'
            ],
            'image' => [
                'image', 'max:1048576', 'dimensions:min_width=100,min_height=100',
            ],
            'status' => 'required|in:active,archived',
            'tags' => 'array',
        ];
    }

    //local scope

    public function scopeFilter( Builder $builder,$filters){

        $builder->when(isset($filters['search']), function ($query) use ($filters) {
            $query->where('categories.name', 'LIKE', '%' . $filters['search'] . '%');
        });

        $builder->when(isset($filters['status']), function ($query) use ($filters) {
            $query->where('categories.status', $filters['status']);
        });
    }



    //relation one to many


        public function products(): HasMany
        {
            return $this->hasMany(Product::class, 'category_id', 'id');
        }



}
