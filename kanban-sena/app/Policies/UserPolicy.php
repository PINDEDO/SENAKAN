<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->isAdmin() || $user->isCoordinador();
    }

    /**
     * Informes institucionales (defensa en profundidad además del middleware por rol).
     */
    public function viewAdministrativeReports(User $actor, User $subject): bool
    {
        return $actor->id === $subject->id && ($actor->isAdmin() || $actor->isCoordinador());
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, string $roleToCreate): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        if ($user->isCoordinador()) {
            // Coordinador can create Coordinadores and Funcionarios
            // But NOT Admins
            return in_array($roleToCreate, ['coordinador', 'funcionario', 'instructor']);
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        if ($user->isCoordinador()) {
            // Coordinator cannot edit Admin
            if ($model->isAdmin()) {
                return false;
            }

            // Coordinator can edit Officials and other Coordinators?
            // User said: "coordinadores no podran gestionar al cordinador original"
            // Interpreting as: Coordinators cannot edit other Coordinators of same level or higher?
            // Usually simpler: Coordinators can edit anyone except Admins.
            return true;
        }

        return $user->id === $model->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        // No one can delete themselves
        if ($user->id === $model->id) {
            return false;
        }

        if ($user->isAdmin()) {
            return true;
        }

        if ($user->isCoordinador()) {
            // Coordinator cannot delete Admin
            if ($model->isAdmin()) {
                return false;
            }

            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can change credentials (password) of the model.
     */
    public function changeCredentials(User $user, User $model): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        if ($user->isCoordinador()) {
            // User said: "el usuario cordinador no podra editar las credenciales d elos funcionarios"
            if ($model->isFuncionario() || $model->isInstructor()) {
                return false;
            }

            return true;
        }

        return $user->id === $model->id;
    }
}
