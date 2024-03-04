<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['total'];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }

    /**
     * Function to calculate total amount of all products in cart
     *
     * @return int
     * */
    public function calculateTotal(): int
    {
        $products = $this->load('products');
        $total = 0;

        foreach($products->products as $product)
        {
            $total += $product->pivot->quantity * $product->price;
        }
        return $total;
    }

    public function getTotalAttribute():int
    {
        return $this->calculateTotal();
    }
}
