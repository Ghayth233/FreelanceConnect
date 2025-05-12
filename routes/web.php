<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TravailController;
use App\Http\Controllers\OffreController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Routes publiques
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// Routes d'authentification
Auth::routes(['verify' => true]);

// Routes protégées par authentification
Route::middleware(['auth', 'verified'])->group(function () {
    // Routes pour les travaux (clients et freelances)
    Route::get('/travaux', [TravailController::class, 'index'])->name('travaux.index');
    Route::get('/travaux/all', [TravailController::class, 'all'])->name('travaux.all');
    
    // Routes protégées par rôle client
    Route::middleware(['role:client'])->group(function () {
        Route::get('/travaux/create', [TravailController::class, 'create'])->name('travaux.create');
        Route::post('/travaux', [TravailController::class, 'store'])->name('travaux.store');
        Route::get('/travaux/{travail}/edit', [TravailController::class, 'edit'])->name('travaux.edit');
        Route::put('/travaux/{travail}', [TravailController::class, 'update'])->name('travaux.update');
        Route::delete('/travaux/{travail}', [TravailController::class, 'destroy'])->name('travaux.destroy');
        Route::post('/travaux/{travail}/complete', [TravailController::class, 'markAsCompleted'])->name('travaux.complete');
    });

    // Routes pour les offres (freelances et clients)
    Route::get('/offres', [OffreController::class, 'index'])->name('offres.index');
    Route::get('/offres/{offre}', [OffreController::class, 'show'])->name('offres.show');
    
    // Routes protégées par rôle freelance
    Route::middleware(['role:freelance'])->group(function () {
        Route::post('/travaux/{travail}/offres', [OffreController::class, 'store'])->name('offres.store');
        Route::get('/offres/{offre}/edit', [OffreController::class, 'edit'])->name('offres.edit');
        Route::put('/offres/{offre}', [OffreController::class, 'update'])->name('offres.update');
        Route::delete('/offres/{offre}', [OffreController::class, 'destroy'])->name('offres.destroy');
    });
    
    // Route pour accepter une offre (client uniquement)
    Route::post('/offres/{offre}/accept', [OffreController::class, 'accept'])
        ->middleware('role:client')
        ->name('offres.accept');
    
    // Route protégée pour afficher un travail
    Route::get('/travaux/{travail}', [TravailController::class, 'show'])->name('travaux.show');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
