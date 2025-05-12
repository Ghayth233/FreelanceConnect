<x-app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('À propos de nous') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="max-w-3xl mx-auto">
                        <div class="text-center mb-12">
                            <h1 class="text-4xl font-bold text-gray-900 mb-4">Notre mission</h1>
                            <p class="text-xl text-gray-600">
                                Connecter les talents aux opportunités, une mission à la fois.
                            </p>
                        </div>

                        <div class="prose max-w-none
                            <h2 class="text-2xl font-bold text-gray-800 mb-6">Notre histoire</h2>
                            <p class="mb-6 text-gray-700">
                                Fondée en 2023, notre plateforme est née d'un constat simple : il est souvent difficile pour les indépendants de trouver des projets passionnants et pour les entreprises de dénicher les bons talents. Nous avons créé cet espace pour faciliter ces connexions et permettre à chacun de trouver sa place dans l'économie des freelances.
                            </p>

                            <h2 class="text-2xl font-bold text-gray-800 mb-6 mt-12">Notre équipe</h2>
                            <div class="grid md:grid-cols-3 gap-8 mb-12">
                                <div class="text-center">
                                    <div class="w-32 h-32 mx-auto bg-gray-200 rounded-full mb-4"></div>
                                    <h3 class="text-lg font-semibold">Jean Dupont</h3>
                                    <p class="text-indigo-600">CEO & Fondateur</p>
                                    <p class="text-sm text-gray-600 mt-2">Expert en développement web avec plus de 10 ans d'expérience dans l'industrie tech.</p>
                                </div>
                                <div class="text-center">
                                    <div class="w-32 h-32 mx-auto bg-gray-200 rounded-full mb-4"></div>
                                    <h3 class="text-lg font-semibold">Marie Martin</h3>
                                    <p class="text-indigo-600">Responsable des opérations</p>
                                    <p class="text-sm text-gray-600 mt-2">Spécialiste en gestion de projets et en relations client-freelance.</p>
                                </div>
                                <div class="text-center">
                                    <div class="w-32 h-32 mx-auto bg-gray-200 rounded-full mb-4"></div>
                                    <h3 class="text-lg font-semibold">Thomas Leroy</h3>
                                    <p class="text-indigo-600">Responsable technique</p>
                                    <p class="text-sm text-gray-600 mt-2">Développeur full-stack passionné par la création d'outils innovants.</p>
                                </div>
                            </div>

                            <h2 class="text-2xl font-bold text-gray-800 mb-6">Nos valeurs</h2>
                            <div class="grid md:grid-cols-3 gap-8 mb-12">
                                <div class="bg-gray-50 p-6 rounded-lg">
                                    <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center mb-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <h3 class="font-semibold text-lg mb-2">Transparence</h3>
                                    <p class="text-gray-600">Nous croyons en la transparence des échanges et des transactions pour bâtir des relations de confiance.</p>
                                </div>
                                <div class="bg-gray-50 p-6 rounded-lg">
                                    <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center mb-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                        </svg>
                                    </div>
                                    <h3 class="font-semibold text-lg mb-2">Innovation</h3>
                                    <p class="text-gray-600">Nous repoussons les limites pour offrir des solutions innovantes à nos utilisateurs.</p>
                                </div>
                                <div class="bg-gray-50 p-6 rounded-lg">
                                    <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center mb-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                    </div>
                                    <h3 class="font-semibold text-lg mb-2">Communauté</h3>
                                    <p class="text-gray-600">Nous construisons une communauté bienveillante de professionnels talentueux.</p>
                                </div>
                            </div>

                            <div class="bg-indigo-50 p-6 rounded-lg">
                                <h3 class="text-xl font-semibold text-gray-900 mb-4">Rejoignez notre communauté</h3>
                                <p class="text-gray-700 mb-6">
                                    Que vous soyez freelance à la recherche de projets passionnants ou entreprise en quête de talents, notre plateforme est faite pour vous. Inscrivez-vous dès maintenant pour commencer votre aventure.
                                </p>
                                <div class="flex flex-col sm:flex-row gap-4">
                                    <a href="{{ route('register') }}?role=freelance" class="px-6 py-3 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition-colors text-center">
                                        Devenir Freelance
                                    </a>
                                    <a href="{{ route('register') }}" class="px-6 py-3 border border-indigo-600 text-indigo-600 rounded-md hover:bg-indigo-50 transition-colors text-center">
                                        Trouver un Freelance
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app>
