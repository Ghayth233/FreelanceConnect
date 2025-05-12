<x-app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bienvenue sur notre plateforme de freelance') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-message />
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Trouvez ou proposez des missions freelance</h3>
                    <p class="text-gray-600 mb-4">
                        Notre plateforme met en relation des clients et des freelances pour des projets variés.
                        Que vous cherchiez à embaucher ou à être embauché, vous êtes au bon endroit !
                    </p>
                    
                    <div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-2">
                        @guest
                            <div class="bg-gray-50 p-6 rounded-lg">
                                <h4 class="font-medium text-gray-900 mb-2">Vous êtes client ?</h4>
                                <p class="text-sm text-gray-600 mb-4">Publiez vos projets et trouvez le freelance idéal pour les réaliser.</p>
                                <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Créer un compte client
                                </a>
                            </div>
                            
                            <div class="bg-gray-50 p-6 rounded-lg">
                                <h4 class="font-medium text-gray-900 mb-2">Vous êtes freelance ?</h4>
                                <p class="text-sm text-gray-600 mb-4">Trouvez des missions qui correspondent à vos compétences et à votre emploi du temps.</p>
                                <a href="{{ route('register') }}?role=freelance" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Créer un compte freelance
                                </a>
                            </div>
                        @else
                            <div class="bg-gray-50 p-6 rounded-lg">
                                <h4 class="font-medium text-gray-900 mb-2">
                                    {{ auth()->user()->isClient() ? 'Publier un nouveau projet' : 'Parcourir les projets' }}
                                </h4>
                                <p class="text-sm text-gray-600 mb-4">
                                    {{ auth()->user()->isClient() 
                                        ? 'Déposez votre projet et recevez des propositions de freelances qualifiés.'
                                        : 'Consultez les projets disponibles et postulez à ceux qui correspondent à vos compétences.' }}
                                </p>
                                <a href="{{ auth()->user()->isClient() ? route('travaux.create') : route('travaux.all') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    {{ auth()->user()->isClient() ? 'Publier un projet' : 'Voir les projets' }}
                                </a>
                            </div>
                            
                            <div class="bg-gray-50 p-6 rounded-lg">
                                <h4 class="font-medium text-gray-900 mb-2">
                                    {{ auth()->user()->isClient() ? 'Vos projets' : 'Vos offres' }}
                                </h4>
                                <p class="text-sm text-gray-600 mb-4">
                                    {{ auth()->user()->isClient() 
                                        ? 'Gérez vos projets en cours et les propositions reçues.'
                                        : 'Suivez l\'état de vos candidatures et vos missions en cours.' }}
                                </p>
                                <a href="{{ auth()->user()->isClient() ? route('travaux.index') : route('offres.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    {{ auth()->user()->isClient() ? 'Voir mes projets' : 'Voir mes offres' }}
                                </a>
                            </div>
                        @endguest
                    </div>
                </div>
            </div>
            
            @if(isset($recentTravaux) && $recentTravaux->count() > 0)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Projets récents</h3>
                        <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                            @foreach($recentTravaux as $travail)
                                <div class="border rounded-lg p-4 hover:shadow-md transition-shadow">
                                    <h4 class="font-medium text-indigo-600">{{ $travail->titre }}</h4>
                                    <p class="text-sm text-gray-600 mt-1 line-clamp-2">{{ $travail->description }}</p>
                                    <div class="mt-3 flex justify-between items-center">
                                        <span class="text-xs text-gray-500">Budget: {{ number_format($travail->budget, 0, ',', ' ') }} €</span>
                                        <span class="text-xs text-gray-500">{{ $travail->created_at->diffForHumans() }}</span>
                                    </div>
                                    <div class="mt-3">
                                        <a href="{{ route('travaux.show', $travail) }}" class="text-sm text-indigo-600 hover:text-indigo-800">Voir les détails</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('travaux.all') }}" class="text-sm text-indigo-600 hover:text-indigo-800">Voir tous les projets →</a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app>
