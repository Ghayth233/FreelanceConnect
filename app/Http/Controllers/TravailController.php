<?php

namespace App\Http\Controllers;

use App\Models\Travail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TravailController extends Controller
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
        $travaux = Travail::where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('travaux.index', compact('travaux'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('travaux.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'budget' => 'required|numeric|min:0',
            'date_limite' => 'required|date|after:today',
        ]);

        $travail = new Travail($validated);
        $travail->user_id = Auth::id();
        $travail->slug = Str::slug($validated['titre']) . '-' . uniqid();
        $travail->save();

        return redirect()->route('travaux.show', $travail)
            ->with('success', 'Travail publié avec succès !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Travail  $travail
     * @return \Illuminate\Http\Response
     */
    public function show(Travail $travail)
    {
        $this->authorize('view', $travail);
        $offres = $travail->offres()->with('freelance')->latest()->get();
        
        return view('travaux.show', compact('travail', 'offres'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Travail  $travail
     * @return \Illuminate\Http\Response
     */
    public function edit(Travail $travail)
    {
        $this->authorize('update', $travail);
        return view('travaux.edit', compact('travail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Travail  $travail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Travail $travail)
    {
        $this->authorize('update', $travail);

        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'budget' => 'required|numeric|min:0',
            'date_limite' => 'required|date|after:today',
            'statut' => 'required|in:ouvert,en_cours,termine,annule',
        ]);

        $travail->update($validated);

        return redirect()->route('travaux.show', $travail)
            ->with('success', 'Travail mis à jour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Travail  $travail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Travail $travail)
    {
        $this->authorize('delete', $travail);
        $travail->delete();

        return redirect()->route('travaux.index')
            ->with('success', 'Travail supprimé avec succès !');
    }

    public function all()
    {
        $travaux = Travail::where('statut', 'ouvert')
            ->with('client')
            ->latest()
            ->paginate(12);

        return view('travaux.all', compact('travaux'));
    }
}
