<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TravailController;
use App\Http\Controllers\OrdreController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::resource('travaux', TravailController::class)->parameters([
    'travaux' => 'travail'
]);

// Routes pour les ordres (propositions des freelancers)
Route::resource('ordres', OrdreController::class)->except(['create', 'store']);
Route::get('/travaux/{travail}/proposer', [OrdreController::class, 'create'])->name('ordres.create');
Route::post('/travaux/{travail}/proposer', [OrdreController::class, 'store'])->name('ordres.store');

// Mise à jour du statut d'une proposition
Route::post('/ordres/{ordre}/status', [OrdreController::class, 'updateStatus'])->name('ordres.status');
