<?php

namespace App\Http\Controllers;

use App\Models\Travail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Affiche la page d'accueil
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();
        
        if ($user) {
            if ($user->isClient()) {
                // Pour les clients, afficher leurs propres travaux
                $travaux = $user->travails()
                    ->with(['offres', 'user'])
                    ->latest()
                    ->paginate(10);
                
                return view('home', compact('travaux'));
                
            } elseif ($user->isFreelance()) {
                // Pour les freelances, afficher les travaux disponibles
                $travaux = Travail::where('status', 'en_attente')
                    ->whereDoesntHave('offres', function($query) use ($user) {
                        $query->where('freelance_id', $user->id);
                    })
                    ->with(['user'])
                    ->latest()
                    ->paginate(10);
                
                return view('home', compact('travaux'));
            }
        }
        
        // Pour les invités ou autres rôles
        return view('welcome');
    }
    
    /**
     * Affiche la page À propos
     *
     * @return \Illuminate\View\View
     */
    public function about()
    {
        return view('about');
    }
}
