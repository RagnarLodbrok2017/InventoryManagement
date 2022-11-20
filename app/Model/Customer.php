<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name', 'email', 'password', 'balance', 'pay_amount', 'photo', 'address', 'phone',
    ];

    protected $table = 'customers';
}
