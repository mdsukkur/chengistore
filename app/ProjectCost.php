<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectCost extends Model
{
    protected $guarded = [];

    public function project()
    {
        return $this->belongsTo(ProjectDetails::class, 'project_id');
    }
}
