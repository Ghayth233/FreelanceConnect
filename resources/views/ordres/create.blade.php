@extends('layouts.app')

@section('title', 'Postuler à l\'offre : ' . $travail->titre)

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    .create-container {
        @apply py-8 bg-gradient-to-b from-gray-50 to-gray-100;
    }
    .create-card {
        @apply bg-white shadow-xl rounded-xl overflow-hidden max-w-7xl mx-auto;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
    .create-header {
        @apply px-6 py-6 border-b border-gray-200 bg-gradient-to-r from-white to-gray-50;
    }
    .create-title {
        @apply text-2xl font-bold text-gray-900 sm:text-3xl;
    }
    .offer-details {
        @apply mb-8 bg-white shadow overflow-hidden sm:rounded-lg;
    }
    .offer-header {
        @apply px-6 py-5 bg-blue-50 border-b border-blue-100;
    }
    .offer-title {
        @apply text-lg font-medium text-blue-800;
    }
    .offer-description {
        @apply mt-1 text-sm text-blue-600;
    }
    .offer-grid {
        @apply grid grid-cols-1 gap-4 sm:grid-cols-3 px-6 py-5;
    }
    .offer-label {
        @apply text-sm font-medium text-gray-500;
    }
    .offer-value {
        @apply mt-1 text-sm text-gray-900;
    }
    .offer-badge {
        @apply inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800;
    }
    .form-section {
        @apply px-6 py-6;
    }
    .form-grid {
        @apply grid grid-cols-1 gap-6 sm:grid-cols-6;
    }
    .form-label {
        @apply block text-sm font-medium text-gray-700 mb-1;
    }
    .form-input {
        @apply mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md transition duration-200;
    }
    .form-input-error {
        @apply border-red-300 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500;
    }
    .form-error {
        @apply mt-2 text-sm text-red-600;
    }
    .form-textarea {
        @apply shadow-sm focus:ring-blue-500 focus:border-blue-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md transition duration-200;
    }
    .form-actions {
        @apply px-6 py-4 bg-gray-50 text-right border-t border-gray-200;
    }
    
    /* Boutons améliorés */
    .btn-primary {
        @apply inline-flex items-center px-5 py-2.5 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200;
    }
    .btn-secondary {
        @apply inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200;
    }
</style>
@endpush

@section('content')
<div class="create-container">
    <div class="create-card">
        <!-- Header -->
        <div class="create-header">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="create-title">
                        <i class="fas fa-paper-plane text-blue-500 mr-3"></i>
                        Postuler à l'offre : {{ $travail->titre }}
                    </h1>
                </div>
                <div>
                    <a href="{{ route('travaux.show', $travail) }}" class="btn-secondary">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Retour à l'offre
                    </a>
                </div>
            </div>
        </div>

        <!-- Offer Details -->
        <div class="offer-details">
            <div class="offer-header">
                <h3 class="offer-title">
                    <i class="fas fa-info-circle mr-2"></i>
                    Détails de l'offre
                </h3>
                <p class="offer-description">
                    Informations sur le projet auquel vous postulez
                </p>
            </div>
            <div class="offer-grid">
                <div>
                    <dt class="offer-label">Titre</dt>
                    <dd class="offer-value">{{ $travail->titre }}</dd>
                </div>
                <div>
                    <dt class="offer-label">Catégorie</dt>
                    <dd class="offer-value">
                        <span class="offer-badge">
                            <i class="fas fa-tag mr-1"></i>
                            {{ ucfirst($travail->categorie) }}
                        </span>
                    </dd>
                </div>
                <div>
                    <dt class="offer-label">Budget</dt>
                    <dd class="offer-value">
                        <i class="fas fa-euro-sign mr-1"></i>
                        {{ number_format($travail->budget, 0, ',', ' ') }} €
                    </dd>
                </div>
                <div>
                    <dt class="offer-label">Date limite</dt>
                    <dd class="offer-value">
                        <i class="fas fa-calendar-alt mr-1"></i>
                        {{ \Carbon\Carbon::parse($travail->date_limite)->format('d/m/Y') }}
                    </dd>
                </div>
                <div class="sm:col-span-3">
                    <dt class="offer-label">Description</dt>
                    <dd class="offer-value">{{ $travail->description }}</dd>
                </div>
            </div>
        </div>

        <!-- Application Form -->
        <form action="{{ route('ordres.store', ['travail' => $travail->id]) }}" method="POST">
            @csrf
            <div class="form-section">
                <div class="form-grid">
                    <!-- Freelancer Name -->
                    <div class="sm:col-span-3">
                        <label for="freelancer_nom" class="form-label">
                            <i class="fas fa-user text-blue-500 mr-2"></i>
                            Votre nom
                        </label>
                        <input type="text" name="freelancer_nom" id="freelancer_nom" value="{{ old('freelancer_nom') }}" required 
                               class="form-input @error('freelancer_nom') form-input-error @enderror">
                        @error('freelancer_nom')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Freelancer Email -->
                    <div class="sm:col-span-3">
                        <label for="freelancer_email" class="form-label">
                            <i class="fas fa-envelope text-blue-500 mr-2"></i>
                            Votre email
                        </label>
                        <input type="email" name="freelancer_email" id="freelancer_email" value="{{ old('freelancer_email') }}" required 
                               class="form-input @error('freelancer_email') form-input-error @enderror">
                        @error('freelancer_email')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Proposal -->
                    <div class="sm:col-span-6">
                        <label for="proposition" class="form-label">
                            <i class="fas fa-comment-dots text-blue-500 mr-5"></i>
                            Votre proposition
                        </label>
                        <textarea id="proposition" name="proposition" rows="6" cols="50 " required 
                                  class="form-textarea  @error('proposition') form-input-error @enderror" 
                                  placeholder="Décrivez votre approche, votre expérience et pourquoi vous êtes le meilleur choix pour ce projet.">{{ old('proposition') }}</textarea>
                        @error('proposition')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Proposed Price -->
                    <div class="sm:col-span-3">
                        <label for="prix_propose" class="form-label">
                            <i class="fas fa-euro-sign text-blue-500 mr-2"></i>
                            Votre tarif (€)
                        </label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">€</span>
                            </div>
                            <input type="number" name="prix_propose" id="prix_propose" value="{{ old('prix_propose') }}" min="0" step="0.01" required 
                                   class="form-input pl-7 @error('prix_propose') form-input-error @enderror" placeholder="0.00">
                        </div>
                        @error('prix_propose')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Delivery Time -->
                    <div class="sm:col-span-3">
                        <label for="delai_jours" class="form-label">
                            <i class="fas fa-clock text-blue-500 mr-2"></i>
                            Délai de réalisation (jours)
                        </label>
                        <input type="number" name="delai_jours" id="delai_jours" value="{{ old('delai_jours') }}" min="1" required 
                               class="form-input @error('delai_jours') form-input-error @enderror">
                        @error('delai_jours')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <button type="submit" class="btn-primary">
                    <i class="fas fa-paper-plane mr-2"></i>
                    Envoyer ma proposition
                </button>
            </div>
        </form>
    </div>
</div>
@endsection