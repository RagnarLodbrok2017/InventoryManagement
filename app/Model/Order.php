<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'product_quantity','total_payment', 'tax', 'discount', 'month',
        'year', 'date', 'user_id', 'customer_id', 'payment_id'
    ];

    protected $table = 'orders';

    //many to many relation with orders
    public function products()
    {
        return $this->belongsToMany('App\Model\Order','orders_products','order_id','product_id');
    }


    public function payment()
    {
            return $this->hasMany('App\Model\Payment','payment_id','id');
    }
    public function customer()
    {
            return $this->hasMany('App\Model\customer','customer_id','id');
    }
    public function user()
    {
            return $this->hasMany('App\Model\user','user_id','id');
    }
}
