<?php

namespace App\Http\Controllers;

use App\Models\Travail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TravailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Travail::where('statut', 'disponible');
        
        // Gestion de la recherche
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('titre', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%")
                  ->orWhere('categorie', 'LIKE', "%{$search}%");
            });
        }
        
        // Gestion du filtre par catégorie
        if ($request->has('categorie') && $request->categorie !== 'toutes') {
            $query->where('categorie', $request->categorie);
        }
        
        // Tri et pagination (3 éléments par page)
        $travaux = $query->orderBy('created_at', 'desc')
                        ->paginate(3)
                        ->appends($request->query());
        
        // Récupérer les catégories uniques pour le filtre
        $categories = Travail::select('categorie')
                           ->distinct()
                           ->pluck('categorie');
            
        return view('travaux.index', compact('travaux', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('travaux.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string|min:16',
            'budget' => 'required|numeric|min:0',
            'categorie' => 'required|string|max:100',
            'date_limite' => 'required|date|after:today',
        ]);

        $travail = Travail::create($validated);
        
        return redirect()->route('travaux.show', $travail)
            ->with('success', 'Travail publié avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Travail $travail)
    {
        return view('travaux.show', compact('travail'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Travail $travail)
    {
        return view('travaux.edit', compact('travail'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Travail $travail)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'budget' => 'required|numeric|min:0',
            'categorie' => 'required|string|max:100',
            'statut' => 'required|in:disponible,en_cours,termine',
            'date_limite' => 'required|date',
        ]);

        $travail->update($validated);
        
        return redirect()->route('travaux.show', $travail)
            ->with('success', 'Travail mis à jour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Travail $travail)
    {
        $travail->delete();
        
        return redirect()->route('travaux.index')
            ->with('success', 'Travail supprimé avec succès !');
    }
}
