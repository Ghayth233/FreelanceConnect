@extends('layouts.app')

@section('title', 'Modifier l\'offre : ' . $travail->titre)

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    .edit-job-container {
        @apply py-10 bg-gradient-to-br from-gray-50 to-gray-100;
    }
    .edit-job-card {
        @apply bg-white shadow-xl rounded-xl overflow-hidden max-w-7xl mx-auto px-4 sm:px-6 lg:px-8;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
    .edit-header {
        @apply px-6 py-6 border-b border-gray-200 bg-gradient-to-r from-white to-gray-50;
    }
    .edit-header-content {
        @apply flex flex-col md:flex-row md:justify-between md:items-center gap-6;
    }
    .edit-title {
        @apply text-3xl font-bold text-gray-900 leading-tight;
    }
    .form-section {
        @apply px-6 py-8 space-y-6;
    }
    .form-group {
        @apply space-y-2;
    }
    .form-label {
        @apply block text-sm font-semibold text-gray-700 flex items-center;
    }
    .form-input {
        @apply block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm transition-all duration-300 
               focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500;
    }
    .form-error {
        @apply text-sm text-red-600 mt-1;
    }
    .btn-primary {
        @apply inline-flex items-center px-5 py-2.5 border border-transparent text-sm font-medium rounded-lg 
               shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 
               focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200;
    }
    .btn-secondary {
        @apply inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium 
               rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 
               focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200;
    }
    .btn-delete {
        @apply inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md 
               shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 
               focus:ring-offset-2 focus:ring-red-500 transition-all duration-200;
    }
    .danger-zone {
        @apply bg-white shadow overflow-hidden sm:rounded-lg border border-red-200;
    }
    .danger-zone-header {
        @apply px-4 py-5 sm:px-6 bg-red-50;
    }
    .danger-zone-content {
        @apply border-t border-red-200 px-4 py-5 sm:px-6;
    }
</style>
@endpush

@section('content')
<div class="edit-job-container">
    <div class="edit-job-card">
        <!-- Header -->
        <div class="edit-header">
            <div class="edit-header-content">
                <h1 class="edit-title">
                    <i class="fas fa-edit mr-3 text-blue-600"></i>
                    Modifier l'offre : {{ $travail->titre }}
                </h1>
                
                <div class="flex-shrink-0">
                    <a href="{{ route('travaux.show', ['travail' => $travail->id]) }}" class="btn-secondary">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Retour à l'offre
                    </a>
                </div>
            </div>
        </div>

        <!-- Main Form -->
        <form action="{{ route('travaux.update', $travail) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-section">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Job Title -->
                    <div class="form-group">
                        <label for="titre" class="form-label">
                            <i class="fas fa-heading mr-2 text-blue-500"></i>
                            Titre de l'offre
                        </label>
                        <input type="text" name="titre" id="titre" 
                               value="{{ old('titre', $travail->titre) }}" 
                               required 
                               class="form-input @error('titre') border-red-500 @enderror">
                        @error('titre')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div class="form-group">
                        <label for="categorie" class="form-label">
                            <i class="fas fa-tags mr-2 text-blue-500"></i>
                            Catégorie
                        </label>
                        <select id="categorie" name="categorie" class="form-input @error('categorie') border-red-500 @enderror">
                            @php
                            $categories = [
                                'developpement' => 'Développement Web',
                                'design' => 'Design Graphique',
                                'redaction' => 'Rédaction',
                                'marketing' => 'Marketing Digital',
                                'conseil' => 'Conseil',
                                'formation' => 'Formation',
                                'autre' => 'Autre'
                            ];
                            @endphp
                            @foreach($categories as $key => $label)
                                <option value="{{ $key }}" 
                                    {{ old('categorie', $travail->categorie) == $key ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @error('categorie')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Budget -->
                    <div class="form-group">
                        <label for="budget" class="form-label">
                            <i class="fas fa-euro-sign mr-2 text-blue-500"></i>
                            Budget (€)
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">€</span>
                            </div>
                            <input type="number" name="budget" id="budget" 
                                   value="{{ old('budget', $travail->budget) }}" 
                                   min="0" step="0.01" 
                                   class="form-input pl-7 @error('budget') border-red-500 @enderror" 
                                   placeholder="0.00">
                        </div>
                        @error('budget')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Deadline -->
                    <div class="form-group">
                        <label for="date_limite" class="form-label">
                            <i class="fas fa-calendar-alt mr-2 text-blue-500"></i>
                            Date limite de candidature
                        </label>
                        <input type="date" name="date_limite" id="date_limite" 
                               value="{{ old('date_limite', $travail->date_limite ? (is_string($travail->date_limite) ? $travail->date_limite : $travail->date_limite->format('Y-m-d')) : '') }}" 
                               min="{{ date('Y-m-d') }}" 
                               class="form-input @error('date_limite') border-red-500 @enderror">
                        @error('date_limite')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="form-group">
                        <label for="statut" class="form-label">
                            <i class="fas fa-info-circle mr-2 text-blue-500"></i>
                            Statut
                        </label>
                        <select id="statut" name="statut" class="form-input">
                            <option value="disponible" {{ old('statut', $travail->statut) == 'disponible' ? 'selected' : '' }}>
                                Disponible
                            </option>
                            <option value="en_cours" {{ old('statut', $travail->statut) == 'en_cours' ? 'selected' : '' }}>
                                En cours
                            </option>
                            <option value="termine" {{ old('statut', $travail->statut) == 'termine' ? 'selected' : '' }}>
                                Terminé
                            </option>
                        </select>
                    </div>
                </div>

                <!-- Description -->
                <div class="form-group mt-6">
                    <label for="description" class="form-label">
                        <i class="fas fa-file-alt mr-2 text-blue-500"></i>
                        Description détaillée
                    </label>
                    <textarea id="description" name="description" rows="8" 
                              class="form-input @error('description') border-red-500 @enderror">{{ old('description', $travail->description) }}</textarea>
                    @error('description')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="mt-8 text-right">
                    <button type="submit" class="btn-primary">
                        <i class="fas fa-save mr-2"></i>
                        Enregistrer les modifications
                    </button>
                </div>
            </div>
        </form>

        <!-- Danger Zone -->
        <div class="mt-8 danger-zone">
            <div class="danger-zone-header">
                <h3 class="text-lg leading-6 font-semibold text-red-800">
                    <i class="fas fa-exclamation-triangle mr-3 text-red-600"></i>
                    Zone dangereuse
                </h3>
                <p class="mt-2 text-sm text-red-600">
                    Cette action est irréversible. Soyez certain de votre choix.
                </p>
            </div>
            <div class="danger-zone-content">
                <form action="{{ route('travaux.destroy', $travail) }}" 
                      method="POST" 
                      onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette offre ? Cette action est irréversible.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-delete">
                        <i class="fas fa-trash-alt mr-2"></i>
                        Supprimer cette offre
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Set minimum date to today
    document.addEventListener('DOMContentLoaded', function() {
        const today = new Date().toISOString().split('T')[0];
        const dateLimiteInput = document.getElementById('date_limite');
        
        if (dateLimiteInput && !dateLimiteInput.value) {
            dateLimiteInput.value = today;
        }
    });
</script>
@endpush