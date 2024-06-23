<?php

namespace App\Http\Requests\Category;

use App\Rules\Filter;
use App\Models\Category;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class request_create extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules($id=0): array
    {
        // $id = $this->route('category') ? $this->route('category')->id : 0;

        $categoryId = $this->route('category'); //category =>dashdoard/categories/{category} parameter in route

        // return [

        //     'name' => [
        //         'required', 

        //         'string', 

        //         'max:255',
        //         Rule::unique('categories','name')->ignore($categoryId),

        //         // new Filter(['laravel','html','css','js']),
        //     ],

        //     'description' => 'string|min:3|max:255',
        //     'image' => 'image|mimes:jpeg,png,jpg,gif',
        //     'status' => 'required|in:active,archvied',
        //     'parent_id' => 'nullable|integer|exists:categories,id',
            

        // ];

      
            return Category::rules($categoryId);
        
    }
}
