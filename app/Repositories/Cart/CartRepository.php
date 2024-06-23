<?php
namespace App\Repositories\Cart;

use App\Models\Product;


interface CartRepository
{
    public function get();

    public function add(Product $product,$quantity=1);

    public function update($id,$quantity);

    public function delete($id);

    public function empty();

    public function total():float;

    public function Sub_total():float;

    public function Cart_Subtotal():float;
}
