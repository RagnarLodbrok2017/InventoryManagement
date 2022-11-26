<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable= [
        'name','code','root','buying_price','selling_price','buying_date','photo','quantity','supplier_id','category_id'
    ];
    protected $table = "products";

    public function category()
    {
        return $this->belongsTo('App\Model\Category','category_id', 'id');
    }

    public function supplier()
    {
        return $this->belongsTo('App\Model\Supplier','supplier_id','id');
    }

    public function shopping_cart()
    {
        return $this->belongsToMany('App\Model\ShoppingCart');
    }

    //many to many relation with orders
    public function order()
    {
        return $this->belongsToMany('App\Model\Order','orders_products','product_id','order_id');
    }

}
