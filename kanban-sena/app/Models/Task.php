<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title',
        'description',
        'status',
        'priority',
        'due_date',
        'order',
        'project_id',
        'assigned_to',
        'created_by',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function assignee()
    {
        return $this->belongsTo(User::class , 'assigned_to');
    }

    public function creator()
    {
        return $this->belongsTo(User::class , 'created_by');
    }
}
