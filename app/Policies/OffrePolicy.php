<?php

namespace App\Policies;

use App\Models\Offre;
use App\Models\Travail;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class OffrePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isFreelance();
    }

    public function view(User $user, Offre $offre): bool
    {
        // Le freelance peut voir ses propres offres
        if ($user->isFreelance() && $offre->freelance_id === $user->id) {
            return true;
        }
        
        // Le client peut voir les offres pour ses travaux
        if ($user->isClient() && $offre->travail->user_id === $user->id) {
            return true;
        }
        
        return false;
    }

    public function create(User $user, Travail $travail): bool
    {
        // Vérifié via la méthode createOffre dans TravailPolicy
        return false;
    }

    public function update(User $user, Offre $offre): bool
    {
        // Seul le freelance peut mettre à jour son offre
        // Et seulement si le travail est toujours ouvert
        return $user->isFreelance() && 
               $offre->freelance_id === $user->id && 
               $offre->travail->statut === 'ouvert';
    }

    public function delete(User $user, Offre $offre): bool
    {
        // Le freelance peut supprimer son offre
        // Ou le client peut supprimer les offres de son travail
        return ($user->isFreelance() && $offre->freelance_id === $user->id) ||
               ($user->isClient() && $offre->travail->user_id === $user->id);
    }

    public function restore(User $user, Offre $offre): bool
    {
        return $user->isFreelance() && $offre->freelance_id === $user->id;
    }

    public function forceDelete(User $user, Offre $offre): bool
    {
        return $user->isAdmin();
    }
    
    public function accept(User $user, Offre $offre): bool
    {
        // Seul le propriétaire du travail peut accepter une offre
        // Et seulement si le travail est toujours ouvert
        return $user->isClient() && 
               $offre->travail->user_id === $user->id && 
               $offre->travail->statut === 'ouvert';
    }
}
