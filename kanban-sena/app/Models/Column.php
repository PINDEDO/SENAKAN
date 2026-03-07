<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Column extends Model
{
    protected $fillable = ['name', 'status', 'order', 'project_id'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
