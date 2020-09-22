<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectDetails extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'submitted_by');
    }

    public function partner()
    {
        return $this->hasMany(ProjectPartner::class, 'project_id');
    }

    public function cost()
    {
        return $this->hasMany(ProjectCost::class, 'project_id');
    }

    public function invest_amount()
    {
        return $this->hasMany(ProjectInvestAmount::class, 'project_id');
    }
}
