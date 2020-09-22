<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalaryManagement extends Model
{
    protected $guarded = [];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'emp_id');
    }
}
