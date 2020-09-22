<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupplierMetarialDetails extends Model
{
    protected $guarded = [];

    public function supplier()
    {
        return $this->belongsTo(SupplierManagement::class, 'supplier_id');
    }
}
