<?php

namespace App\Policies;

use App\Models\ActivityLog;
use App\Models\User;

class ActivityLogPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isAdmin() || $user->isCoordinador();
    }

    public function view(User $user, ActivityLog $activityLog): bool
    {
        return $this->viewAny($user);
    }
}
