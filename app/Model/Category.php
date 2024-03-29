<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 'description'
    ];

    protected $table = "categories";

    public function product()
    {
        return $this->hasMany('App\Model\Product');
    }
}
