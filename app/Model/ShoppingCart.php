<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    protected $fillable = [
        'quantity','product_price','total_payment','product_id','customer_id','user_id','id','product_name'
    ];

    protected $table = 'shopping_cart';

    public function product()
    {
        return $this->hasMany('App\Model\Product', 'product_id','id');
    }
}
