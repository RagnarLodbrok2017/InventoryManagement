<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    protected $fillable = [
        'quantity','product_price','total_price','product_id','customer_id','user_id','id','product_name'
    ];

    protected $table = 'shopping_cart';
}
