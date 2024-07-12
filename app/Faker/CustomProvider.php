<?php
namespace App\Faker;

class CustomProvider
{
    protected $categories = [
        'Electronics',
        'Books',
        'Clothing',
        'Home & Kitchen',
        'Sports & Outdoors',
        'Health & Personal Care',
        'Toys & Games',
        'Automotive',
    ];

    public function category()
    {
        return $this->categories[array_rand($this->categories)];
    }
}
