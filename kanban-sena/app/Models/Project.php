<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name',
        'code',
        'description',
        'status',
        'color',
        'user_id',
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Proyectos que el usuario puede listar o abrir (alineado con tablero y políticas).
     */
    public function scopeVisibleToUser(Builder $query, User $user): Builder
    {
        if ($user->isAdmin() || $user->isCoordinador()) {
            return $query;
        }

        return $query->where(function (Builder $q) use ($user) {
            $q->where('user_id', $user->id)
                ->orWhereHas('tasks', function ($tq) use ($user) {
                    $tq->where('assigned_to', $user->id)
                        ->orWhere('created_by', $user->id);
                });
        });
    }
}
