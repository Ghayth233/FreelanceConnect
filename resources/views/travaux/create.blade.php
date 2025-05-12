@extends('layouts.app')

@section('title', 'Publier une offre')

@section('content')
<div class="py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="md:flex md:items-center md:justify-between">
            <div class="flex-1 min-w-0">
                <h1 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">Publier une nouvelle offre</h1>
            </div>
            <div class="mt-4 flex md:mt-0 md:ml-4
                <a href="{{ route('travaux.index') }}" class="btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i>
                Retour à la liste
            </a>
            </div>
        </div>

        <div class="mt-8">
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <form action="{{ route('travaux.store') }}" method="POST">
                    @csrf
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-4">
                                <label for="titre" class="block text-sm font-medium text-gray-700">Titre de l'offre</label>
                                <input type="text" name="titre" id="titre" value="{{ old('titre') }}" required class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('titre') border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 @enderror">
                                @error('titre')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-span-6">
                                <label for="description" class="block text-sm font-medium text-gray-700">Description détaillée</label>
                                <div class="mt-1">
                                    <textarea id="description" name="description" rows="8" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md @error('description') border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 @enderror">{{ old('description') }}</textarea>
                                </div>
                                @error('description')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-2 text-sm text-gray-500">Décrivez en détail le travail à réaliser, les compétences requises et toutes les informations utiles pour les freelancers.</p>
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="categorie" class="block text-sm font-medium text-gray-700">Catégorie</label>
                                <select id="categorie" name="categorie" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('categorie') border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 @enderror">
                                    <option value="">Sélectionnez une catégorie</option>
                                    <option value="developpement" {{ old('categorie') == 'developpement' ? 'selected' : '' }}>Développement Web</option>
                                    <option value="design" {{ old('categorie') == 'design' ? 'selected' : '' }}>Design Graphique</option>
                                    <option value="redaction" {{ old('categorie') == 'redaction' ? 'selected' : '' }}>Rédaction</option>
                                    <option value="marketing" {{ old('categorie') == 'marketing' ? 'selected' : '' }}>Marketing Digital</option>
                                    <option value="conseil" {{ old('categorie') == 'conseil' ? 'selected' : '' }}>Conseil</option>
                                    <option value="formation" {{ old('categorie') == 'formation' ? 'selected' : '' }}>Formation</option>
                                    <option value="autre" {{ old('categorie') == 'autre' ? 'selected' : '' }}>Autre</option>
                                </select>
                                @error('categorie')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="budget" class="block text-sm font-medium text-gray-700">Budget (€)</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">€</span>
                                    </div>
                                    <input type="number" name="budget" id="budget" value="{{ old('budget') }}" min="0" step="0.01" class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-7 pr-12 sm:text-sm border-gray-300 rounded-md @error('budget') border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 @enderror" placeholder="0.00">
                                </div>
                                @error('budget')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <label for="date_limite" class="block text-sm font-medium text-gray-700">Date limite de candidature</label>
                                <input type="date" name="date_limite" id="date_limite" value="{{ old('date_limite') }}" min="{{ date('Y-m-d') }}" class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('date_limite') border-red-300 text-red-900 placeholder-red-300 focus:outline-none focus:ring-red-500 focus:border-red-500 @enderror">
                                @error('date_limite')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Publier l'offre
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Définir la date minimale comme aujourd'hui
    document.addEventListener('DOMContentLoaded', function() {
        const today = new Date().toISOString().split('T')[0];
        const dateLimiteInput = document.getElementById('date_limite');
        
        if (dateLimiteInput && !dateLimiteInput.value) {
            dateLimiteInput.value = today;
        }
    });
</script>
@endpush
@endsection
