<?php

namespace App\Http\Controllers;

use App\Models\Offre;
use App\Models\Travail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OffreController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offres = Offre::where('freelance_id', Auth::id())
            ->with('travail')
            ->latest()
            ->paginate(10);

        return view('offres.index', compact('offres'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Travail  $travail
     * @return \Illuminate\Http\Response
     */
    public function create(Travail $travail)
    {
        $this->authorize('create', [Offre::class, $travail]);
        return view('offres.create', compact('travail'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Travail  $travail
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Travail $travail)
    {
        $this->authorize('create', [Offre::class, $travail]);

        $validated = $request->validate([
            'proposition' => 'required|string|min:50',
            'montant' => 'required|numeric|min:0',
            'delai_jours' => 'required|integer|min:1',
        ]);

        $offre = new Offre($validated);
        $offre->travail_id = $travail->id;
        $offre->freelance_id = Auth::id();
        $offre->save();

        return redirect()->route('travaux.show', $travail)
            ->with('success', 'Votre offre a été soumise avec succès !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Offre  $offre
     * @return \Illuminate\Http\Response
     */
    public function show(Offre $offre)
    {
        $this->authorize('view', $offre);
        return view('offres.show', compact('offre'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Offre  $offre
     * @return \Illuminate\Http\Response
     */
    public function edit(Offre $offre)
    {
        $this->authorize('update', $offre);
        return view('offres.edit', compact('offre'));
    }

    public function update(Request $request, Offre $offre)
    {
        $this->authorize('update', $offre);

        $validated = $request->validate([
            'proposition' => 'required|string|min:50',
            'montant' => 'required|numeric|min:0',
            'delai_jours' => 'required|integer|min:1',
        ]);

        $offre->update($validated);

        return redirect()->route('offres.show', $offre)
            ->with('success', 'Offre mise à jour avec succès !');
    }

    public function destroy(Offre $offre)
    {
        $this->authorize('delete', $offre);
        $travailId = $offre->travail_id;
        $offre->delete();

        return redirect()->route('travaux.show', $travailId)
            ->with('success', 'Offre supprimée avec succès !');
    }

    public function accept(Offre $offre)
    {
        $this->authorize('accept', $offre);
        
        // Refuser toutes les autres offres pour ce travail
        Offre::where('travail_id', $offre->travail_id)
            ->where('id', '!=', $offre->id)
            ->update(['statut' => 'refuse']);
            
        // Mettre à jour le statut de l'offre acceptée
        $offre->update(['statut' => 'accepte']);
        
        // Mettre à jour le statut du travail
        $offre->travail->update(['statut' => 'en_cours']);

        return back()->with('success', 'Offre acceptée avec succès !');
    }
}
