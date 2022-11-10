<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'name','email','phone','address','photo','shopname'
    ];

    protected $table = 'suppliers';

    public function product()
    {
        return $this->hasMany('App\Model\Product');
    }
}
