@extends('layouts.app')

@section('title', 'Liste des offres')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    .job-list-container {
        @apply py-10 bg-gradient-to-br from-gray-50 to-gray-100;
    }
    .job-list-header {
        @apply px-6 py-6 border-b border-gray-200 bg-gradient-to-r from-white to-gray-50;
    }
    .job-card {
        @apply bg-white shadow-xl rounded-xl overflow-hidden transition-all duration-300 hover:shadow-2xl;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
    .job-card-header {
        @apply flex justify-between items-start p-4 border-b border-gray-200;
    }
    .job-category-badge {
        @apply inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold transition-all duration-300;
    }
    .job-title {
        @apply text-lg font-semibold text-gray-900 hover:text-blue-600 transition-colors;
    }
    .job-description {
        @apply text-sm text-gray-600 mt-2 line-clamp-3;
    }
    .job-meta {
        @apply flex flex-wrap items-center gap-x-4 gap-y-3 text-sm text-gray-600 mt-4;
    }
    .job-meta-item {
        @apply flex items-center gap-2;
    }
    .job-actions {
        @apply grid grid-cols-2 gap-3 mt-6 pt-4 border-t border-gray-100;
    }
    .btn-primary {
        @apply inline-flex items-center px-5 py-2.5 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200;
    }
    .btn-secondary {
        @apply inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200;
    }
    .btn-action {
        @apply inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200;
    }
    .empty-state {
        @apply bg-white shadow-xl rounded-xl p-8 text-center border border-gray-200;
    }
    .pagination-container {
        @apply mt-8 flex justify-center;
    }
</style>
@endpush

@section('content')
<div class="job-list-container">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Page Header -->
        <div class="job-list-header mb-8">
            <div class="flex flex-col md:flex-row md:justify-between md:items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">
                        <i class="fas fa-briefcase mr-3 text-blue-600"></i>
                        Offres disponibles
                    </h1>
                    <p class="text-gray-600">Découvrez les dernières opportunités de missions</p>
                </div>
                <div class="mt-4 md:mt-0">
                    <a href="{{ route('travaux.create') }}" class="btn-primary mb-4">
                        <i class="fas fa-plus mr-2 mb-4"></i>
                        Publier une offre
                    </a>
                </div>
            </div>
        </div>

        <!-- Barre de recherche et filtres -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-8">
            <form action="{{ route('travaux.index') }}" method="GET" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Champ de recherche -->
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                        <input type="text" 
                               name="search" 
                               value="{{ request('search') }}"
                               class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Rechercher une offre...">
                    </div>
                    
                    <!-- Filtre par catégorie -->
                    <div>
                        <select name="categorie" 
                                class="block w-full pl-3 pr-10 py-2 text-base border border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 rounded-lg shadow-sm">
                            <option value="toutes" {{ !request('categorie') ? 'selected' : '' }}>Toutes les catégories</option>
                            @foreach($categories as $categorie)
                                <option value="{{ $categorie }}" {{ request('categorie') == $categorie ? 'selected' : '' }}>
                                    {{ $categorie }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- Boutons d'action -->
                    <div class="flex space-x-3">
                        <button type="submit" class="btn-primary flex-1 justify-center">
                            <i class="fas fa-filter mr-2"></i>Filtrer
                        </button>
                        <a href="{{ route('travaux.index') }}" class="btn-secondary flex items-center justify-center">
                            <i class="fas fa-redo mr-2"></i>Réinitialiser
                        </a>
                    </div>
                </div>
            </form>
            
            <!-- Résultats de la recherche -->
            @if(request()->has('search') || request()->has('categorie'))
                <div class="mt-4 text-sm text-gray-600">
                    <p>
                        {{ $travaux->total() }} résultat(s) trouvé(s)
                        @if(request('search'))
                            pour la recherche : <span class="font-semibold">{{ request('search') }}</span>
                        @endif
                        @if(request('categorie') && request('categorie') !== 'toutes')
                            dans la catégorie : <span class="font-semibold">{{ request('categorie') }}</span>
                        @endif
                    </p>
                </div>
            @endif
        </div>

        <!-- Job Listings -->
        @if($travaux->count() > 0)
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @foreach($travaux as $travail)
                    <div class="job-card">
                        <div class="job-card-header">
                            <span class="job-category-badge 
                                {{ match($travail->categorie) {
                                    'Développement Web' => 'bg-blue-100 text-blue-800', 
                                    'Design Graphique' => 'bg-purple-100 text-purple-800',
                                    'Rédaction' => 'bg-green-100 text-green-800',
                                    default => 'bg-gray-100 text-gray-800'
                                } }}">
                                <i class="fas fa-tag mr-2"></i>
                                {{ $travail->categorie }}
                            </span>
                        </div>

                        <div class="p-4">
                            <h3 class="job-title">
                                <a href="{{ route('travaux.show', ['travail' => $travail->id]) }}">
                                    {{ $travail->titre }}
                                </a>
                            </h3>

                            <p class="job-description">
                                {{ Str::limit($travail->description, 150) }}
                            </p>

                            <div class="job-meta">
                                <div class="job-meta-item">
                                    <i class="fas fa-euro-sign text-gray-500"></i>
                                    <span>{{ number_format($travail->budget, 0, ',', ' ') }} €</span>
                                </div>
                                <div class="job-meta-item">
                                    <i class="fas fa-calendar-alt text-gray-500"></i>
                                    <span>
                                        @if($travail->date_limite)
                                            @if(is_string($travail->date_limite))
                                                {{ \Carbon\Carbon::parse($travail->date_limite)->format('d/m/Y') }}
                                            @else
                                                {{ $travail->date_limite->format('d/m/Y') }}
                                            @endif
                                        @else
                                            Non spécifiée
                                        @endif
                                    </span>
                                </div>
                                <div class="job-meta-item">
                                    <i class="fas fa-clock text-gray-500"></i>
                                    <span>Publié {{ $travail->created_at->diffForHumans() }}</span>
                                </div>
                            </div>

                            <div class="job-actions">
                                <a href="{{ route('travaux.show', ['travail' => $travail->id]) }}" class="btn-secondary">
                                    <i class="fas fa-eye mr-2"></i>
                                    Voir les détails
                                </a>
                                <a href="{{ route('ordres.create', ['travail' => $travail->id]) }}" class="btn-action">
                                    <i class="fas fa-paper-plane mr-2"></i>
                                    Postuler
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- Pagination améliorée -->
<div class="pagination-container">
    <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6 rounded-b-lg shadow-sm">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between w-full gap-4">
            <!-- Texte d'information -->
            <div class="text-sm text-gray-700">
                Affichage de 
                <span class="font-semibold">{{ $travaux->firstItem() }}</span>
                à 
                <span class="font-semibold">{{ $travaux->lastItem() }}</span>
                sur 
                <span class="font-semibold">{{ $travaux->total() }}</span> résultats
            </div>

            <!-- Liens de pagination avec Font Awesome -->
            <div class="text-sm">
                <nav class="inline-flex rounded-md shadow-sm" aria-label="Pagination">
                    @if ($travaux->onFirstPage())
                        <span class="px-3 py-2 text-gray-400 bg-gray-100 rounded-l-md cursor-not-allowed">
                            <i class="fas fa-angle-left text-xs"></i>
                        </span>
                    @else
                        <a href="{{ $travaux->previousPageUrl() }}" class="px-3 py-2 bg-white text-gray-700 hover:bg-gray-100 rounded-l-md">
                            <i class="fas fa-angle-left text-xs"></i>
                        </a>
                    @endif

                    <span class="px-4 py-2 bg-gray-50 text-gray-700">
                        Page {{ $travaux->currentPage() }} sur {{ $travaux->lastPage() }}
                    </span>

                    @if ($travaux->hasMorePages())
                        <a href="{{ $travaux->nextPageUrl() }}" class="px-3 py-2 bg-white text-gray-700 hover:bg-gray-100 rounded-r-md">
                            <i class="fas fa-angle-right text-xs"></i>
                        </a>
                    @else
                        <span class="px-3 py-2 text-gray-400 bg-gray-100 rounded-r-md cursor-not-allowed">
                            <i class="fas fa-angle-right text-xs"></i>
                        </span>
                    @endif
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Empty State -->
@else
<div class="empty-state text-center py-12">
    <i class="fas fa-briefcase-slash text-5xl text-gray-400 mb-4"></i>
    <h3 class="text-xl font-semibold text-gray-900 mb-2">Aucune offre disponible</h3>
    <p class="text-gray-600 mb-6">Soyez le premier à publier une offre !</p>
    <a href="{{ route('travaux.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition">
        <i class="fas fa-plus mr-2 text-xs"></i>
        Publier une offre
    </a>
</div>
@endif

</div>
@endsection