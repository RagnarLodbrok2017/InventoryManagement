<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    protected $fillable = [
        'month', 'employee_id', 'year', 'date', 'details', 'type', 'amount'
    ];

    public $table = "salaries";

        public function employee()
        {
            return $this->belongsTo('App\Model\Salary', 'employee_id', 'id');
        }
    
}
