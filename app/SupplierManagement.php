<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupplierManagement extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'submitted_by');
    }
}
