<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'type', 'cardDetails'
    ];

    protected $table = 'payments';

}
