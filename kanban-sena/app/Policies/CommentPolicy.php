<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\Task;
use App\Models\User;

class CommentPolicy
{
    public function view(User $user, Comment $comment): bool
    {
        return $user->can('view', $comment->task);
    }

    /**
     * Alta de comentario en una tarea: mismo alcance que poder actualizar la tarea.
     */
    public function create(User $user, Task $task): bool
    {
        return $user->can('update', $task);
    }

    public function update(User $user, Comment $comment): bool
    {
        if ($user->isAdmin() || $user->isCoordinador()) {
            return true;
        }

        return (int) $comment->user_id === (int) $user->id;
    }

    public function delete(User $user, Comment $comment): bool
    {
        return $this->update($user, $comment);
    }
}
