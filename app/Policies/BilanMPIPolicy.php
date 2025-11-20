<?php

namespace App\Policies;

use App\Models\BilanMPI;
use App\Models\User;

class BilanMPIPolicy
{
    /**
     * Determine if the user can view any bilans.
     * Admin peut voir tous les bilans, user peut voir les siens
     */
    public function viewAny(User $user): bool
    {
        return true; // Tous les utilisateurs authentifiés peuvent accéder à la liste
    }

    /**
     * Determine if the user can view the bilan.
     * Admin peut voir tous les bilans, user peut voir uniquement les siens
     */
    public function view(User $user, BilanMPI $bilanMPI): bool
    {
        return $user->isAdmin() || $bilanMPI->user_id === $user->id;
    }

    /**
     * Determine if the user can create bilans.
     */
    public function create(User $user): bool
    {
        return true; // Tous les utilisateurs authentifiés peuvent créer
    }

    /**
     * Determine if the user can update the bilan.
     * Admin peut modifier tous les bilans, user peut modifier uniquement les siens
     */
    public function update(User $user, BilanMPI $bilanMPI): bool
    {
        return $user->isAdmin() || $bilanMPI->user_id === $user->id;
    }

    /**
     * Determine if the user can delete the bilan.
     * Admin peut supprimer tous les bilans, user peut supprimer uniquement les siens
     */
    public function delete(User $user, BilanMPI $bilanMPI): bool
    {
        return $user->isAdmin() || $bilanMPI->user_id === $user->id;
    }

    /**
     * Determine if the user can restore the bilan.
     * Seulement les admins peuvent restaurer
     */
    public function restore(User $user, BilanMPI $bilanMPI): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine if the user can permanently delete the bilan.
     * Seulement les admins peuvent supprimer définitivement
     */
    public function forceDelete(User $user, BilanMPI $bilanMPI): bool
    {
        return $user->isAdmin();
    }
}
