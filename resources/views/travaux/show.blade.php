@extends('layouts.app')

@section('title', $travail->titre)

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    .job-detail-container {
        @apply py-10 bg-gradient-to-br from-gray-50 to-gray-100;
    }
    .job-card {
        @apply bg-white shadow-xl rounded-xl overflow-hidden max-w-7xl mx-auto px-4 sm:px-6 lg:px-8;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }
    .job-header {
        @apply px-6 py-6 border-b border-gray-200 bg-gradient-to-r from-white to-gray-50;
    }
    .job-header-content {
        @apply flex flex-col md:flex-row md:justify-between md:items-center gap-6;
    }
    .job-title {
        @apply text-3xl font-bold text-gray-900 leading-tight;
    }
    .job-meta {
        @apply flex flex-wrap items-center gap-x-4 gap-y-3 text-sm text-gray-600 mt-3;
    }
    .job-meta-badge {
        @apply inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-indigo-100 text-indigo-800 transition-all hover:bg-indigo-200;
    }
    .job-section {
        @apply px-6 py-8;
    }
    .section-title {
        @apply text-xl font-semibold text-gray-900 mb-4 flex items-center;
    }
    .proposals-section {
        @apply border-t border-gray-200 pt-8;
    }
    .proposal-item {
        @apply bg-white rounded-lg p-6 border border-gray-200 hover:border-gray-300 hover:shadow-md transition-all duration-300 mb-5;
    }
    .card-footer {
        @apply bg-gray-50 px-6 py-5 flex flex-col sm:flex-row justify-between items-center gap-5 border-t border-gray-200;
    }
    
    /* Boutons améliorés */
    .btn-primary {
        @apply inline-flex items-center px-5 py-2.5 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200;
    }
    .btn-secondary {
        @apply inline-flex items-center px-5 py-2.5 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200;
    }
    .btn-accept {
        @apply inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-200;
    }
    .btn-reject {
        @apply inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-all duration-200;
    }
    .btn-edit {
        @apply inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-amber-500 hover:bg-amber-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 transition-all duration-200;
    }
    .btn-delete {
        @apply inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-all duration-200;
    }
    .proposal-count-badge {
        @apply inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-indigo-100 text-indigo-800;
    }
    .freelancer-avatar {
        @apply flex-shrink-0 h-12 w-12 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-semibold text-lg transition-all hover:bg-indigo-200;
    }
    .proposal-content {
        @apply mt-4 text-sm text-gray-700 bg-gray-50 p-4 rounded-lg border border-gray-200;
    }
    .empty-state {
        @apply text-center py-10 bg-white rounded-lg border border-gray-200;
    }
</style>
@endpush

@section('content')
<div class="job-detail-container">
    <div class="job-card">
        <!-- Header -->
        <div class="job-header">
            <div class="job-header-content">
                <div class="space-y-3 flex-grow">
                    <h1 class="job-title">{{ $travail->titre }}</h1>
                    
                    <div class="job-meta">
                        <!-- Category Badge -->
                        <span class="job-meta-badge">
                            <i class="fas fa-briefcase mr-2"></i>
                            {{ $travail->categorie }}
                        </span>
                        
                        <!-- Budget -->
                        <span class="flex items-center">
                            <i class="fas fa-euro-sign mr-2 text-gray-500"></i>
                            {{ number_format($travail->budget, 0, ',', ' ') }} €
                        </span>
                        
                        <!-- Deadline -->
                        <span class="flex items-center">
                            <i class="fas fa-calendar-alt mr-2 text-gray-500"></i>
                            {{ $travail->date_limite ? \Carbon\Carbon::parse($travail->date_limite)->format('d/m/Y') : 'Non spécifiée' }}
                        </span>
                        
                        <!-- Status -->
                        <span class="flex items-center">
                            <i class="fas fa-info-circle mr-2 text-gray-500"></i>
                            {{ $travail->statut === 'disponible' ? 'Recherche active' : ($travail->statut === 'en_cours' ? 'En cours' : 'Terminé') }}
                        </span>
                    </div>
                </div>
                
                <!-- Apply Button -->
                <div class="flex-shrink-0 mt-4 mb-4 md:mt-0">
                    <a href="{{ route('ordres.create', ['travail' => $travail->id]) }}" class="btn-primary">
                        <i class="fas fa-paper-plane mr-2"></i>
                        Postuler à cette offre
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="job-section">
            <!-- Description -->
            <div class="mb-10">
                <h2 class="section-title">
                    <i class="fas fa-file-alt mr-3 text-indigo-500"></i>
                    Description du projet
                </h2>
                <div class="prose max-w-none text-gray-700 leading-relaxed">
                    {!! nl2br(e($travail->description)) !!}
                </div>
            </div>

            <!-- Proposals -->
            <div class="proposals-section">
                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-6 gap-4">
                    <h2 class="section-title">
                        <i class="fas fa-comment-dots mr-3 text-indigo-500"></i>
                        Propositions reçues
                    </h2>
                    <span class="proposal-count-badge">
                        {{ $travail->ordres->count() }} proposition(s)
                    </span>
                </div>

                @if($travail->ordres->count() > 0)
                    <div class="space-y-5">
                        @foreach($travail->ordres as $ordre)
                            <div class="proposal-item">
                                <div class="flex flex-col md:flex-row md:justify-between gap-5">
                                    <!-- Freelancer Info -->
                                    <div class="flex items-start gap-4">
                                        <div class="freelancer-avatar">
                                            {{ substr($ordre->freelancer_nom, 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="font-semibold text-gray-900 text-base">{{ $ordre->freelancer_nom }}</div>
                                            <div class="text-sm text-gray-600">{{ $ordre->freelancer_email }}</div>
                                        </div>
                                    </div>
                                    
                                    <!-- Price and Deadline -->
                                    <div class="text-right">
                                        <div class="font-semibold text-gray-900 text-base">
                                            <i class="fas fa-euro-sign mr-2 text-gray-500"></i>
                                            {{ number_format($ordre->prix_propose, 0, ',', ' ') }} €
                                        </div>
                                        <div class="text-sm text-gray-600">
                                            <i class="fas fa-clock mr-2 text-gray-400"></i>
                                            Délai: {{ $ordre->delai_jours }} jours
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Proposal Text -->
                                <div class="proposal-content">
                                    <i class="fas fa-quote-left mr-3 text-gray-400"></i>
                                    {{ $ordre->proposition }}
                                </div>
                                
                                <!-- Actions -->
                                @if($travail->statut === 'disponible')
                                <div class="mt-4 flex justify-end gap-3">
                                    <form action="{{ route('ordres.status', $ordre) }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="statut" value="accepte">
                                        <button type="submit" class="btn-accept text-xs py-2 px-4">
                                            <i class="fas fa-check mr-2"></i>
                                            Accepter
                                        </button>
                                    </form>
                                    <form action="{{ route('ordres.status', $ordre) }}" method="POST" class="inline">
                                        @csrf
                                        <input type="hidden" name="statut" value="refuse">
                                        <button type="submit" class="btn-reject text-xs py-2 px-4">
                                            <i class="fas fa-times mr-2"></i>
                                            Refuser
                                        </button>
                                    </form>
                                </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <i class="fas fa-comment-slash text-5xl text-gray-400 mb-5"></i>
                        <h3 class="mt-3 text-base font-semibold text-gray-900">Aucune proposition pour le moment</h3>
                        <p class="mt-2 text-sm text-gray-600">Les freelancers peuvent postuler à votre offre.</p>
                    </div>
                @endif
            </div>
        </div>
        
        <!-- Footer -->
        <div class="card-footer">
            <!-- Back to List Button -->
            <a href="{{ route('travaux.index') }}" class="btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i>
                Retour à la liste
            </a>
            
            <!-- Edit and Delete Buttons -->
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('travaux.edit', $travail) }}" class="btn-edit">
                    <i class="fas fa-edit mr-2"></i>
                    Modifier
                </a>
                <form action="{{ route('travaux.destroy', $travail) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette offre ?')">
                        <i class="fas fa-trash-alt mr-2"></i>
                        Supprimer
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection