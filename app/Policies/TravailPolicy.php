<?php

namespace App\Policies;

use App\Models\Travail;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TravailPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Travail $travail): bool
    {
        // Le client peut voir son propre travail
        if ($user->isClient() && $travail->user_id === $user->id) {
            return true;
        }
        
        // Le freelance peut voir les travaux ouverts
        if ($user->isFreelance() && $travail->statut === 'ouvert') {
            return true;
        }
        
        // Un freelance qui a postulé peut voir le travail
        if ($user->isFreelance() && $travail->offres()->where('freelance_id', $user->id)->exists()) {
            return true;
        }
        
        return false;
    }

    public function create(User $user): bool
    {
        // Seuls les clients peuvent créer des travaux
        return $user->isClient();
    }

    public function update(User $user, Travail $travail): bool
    {
        // Seul le propriétaire peut mettre à jour
        return $user->id === $travail->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Travail  $travail
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Travail $travail): bool
    {
        // Seul le propriétaire peut supprimer
        return $user->id === $travail->user_id;
    }

    public function restore(User $user, Travail $travail): bool
    {
        return $user->id === $travail->user_id;
    }

    public function forceDelete(User $user, Travail $travail): bool
    {
        return $user->id === $travail->user_id;
    }
    
    public function createOffre(User $user, Travail $travail): bool
    {
        // Seuls les freelances peuvent postuler
        // Ne peut pas postuler à son propre travail
        // Le travail doit être ouvert
        return $user->isFreelance() && 
               $travail->user_id !== $user->id && 
               $travail->statut === 'ouvert';
    }
}
