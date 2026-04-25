<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;

class ProjectPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Project $project): bool
    {
        if ($user->isAdmin() || $user->isCoordinador()) {
            return true;
        }

        if ($project->user_id === $user->id) {
            return true;
        }

        return $project->tasks()->where(function ($q) use ($user) {
            $q->where('assigned_to', $user->id)
                ->orWhere('created_by', $user->id);
        })->exists();
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Project $project): bool
    {
        if ($user->isAdmin() || $user->isCoordinador()) {
            return true;
        }

        return (int) $project->user_id === (int) $user->id;
    }

    public function delete(User $user, Project $project): bool
    {
        return $this->update($user, $project);
    }

    /**
     * Crear una tarea dentro de este proyecto.
     */
    public function addTask(User $user, Project $project): bool
    {
        if ($user->isAdmin() || $user->isCoordinador()) {
            return true;
        }

        if ((int) $project->user_id === (int) $user->id) {
            return true;
        }

        return $project->tasks()->where(function ($q) use ($user) {
            $q->where('assigned_to', $user->id)
                ->orWhere('created_by', $user->id);
        })->exists();
    }
}
