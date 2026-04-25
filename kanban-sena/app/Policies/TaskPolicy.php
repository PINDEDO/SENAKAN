<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;

class TaskPolicy
{
    public function view(User $user, Task $task): bool
    {
        return $this->update($user, $task);
    }

    public function update(User $user, Task $task): bool
    {
        if ($user->isAdmin() || $user->isCoordinador()) {
            return true;
        }

        if ((int) $task->created_by === (int) $user->id) {
            return true;
        }

        return $task->assigned_to !== null && (int) $task->assigned_to === (int) $user->id;
    }
}
