<?php

namespace App\Http\Controllers;

use App\Models\Ordre;
use App\Models\Travail;
use Illuminate\Http\Request;

class OrdreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ordres = Ordre::with('travail')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('ordres.index', compact('ordres'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($travailId)
    {
        $travail = Travail::findOrFail($travailId);
        return view('ordres.create', compact('travail'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $travailId)
    {
        $validated = $request->validate([
            'freelancer_nom' => 'required|string|max:255',
            'freelancer_email' => 'required|email|max:255',
            'proposition' => 'required|string',
            'prix_propose' => 'required|numeric|min:0',
            'delai_jours' => 'required|integer|min:1',
        ]);

        $validated['travail_id'] = $travailId;
        $validated['statut'] = 'en_attente';

        $travail = \App\Models\Travail::findOrFail($travailId);
        $ordre = Ordre::create($validated);
        
        return redirect()->route('travaux.show', $travail)
            ->with('success', 'Votre proposition a été soumise avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ordre $ordre)
    {
        return view('ordres.show', compact('ordre'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ordre $ordre)
    {
        return view('ordres.edit', compact('ordre'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ordre $ordre)
    {
        $validated = $request->validate([
            'freelancer_nom' => 'required|string|max:255',
            'freelancer_email' => 'required|email|max:255',
            'proposition' => 'required|string',
            'prix_propose' => 'required|numeric|min:0',
            'delai_jours' => 'required|integer|min:1',
            'statut' => 'required|in:en_attente,accepte,refuse,annule',
        ]);

        $ordre->update($validated);
        
        return redirect()->route('ordres.show', $ordre->id)
            ->with('success', 'Proposition mise à jour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ordre $ordre)
    {
        $travailId = $ordre->travail_id;
        $ordre->delete();
        
        return redirect()->route('travaux.show', $travailId)
            ->with('success', 'Proposition supprimée avec succès !');
    }
    
    /**
     * Mettre à jour le statut d'une proposition
     */
    public function updateStatus(Request $request, Ordre $ordre)
    {
        $request->validate([
            'statut' => 'required|in:accepte,refuse,annule',
        ]);
        
        $ordre->update(['statut' => $request->statut]);
        
        return back()->with('success', 'Statut mis à jour avec succès !');
    }
}
