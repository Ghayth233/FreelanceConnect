<x-app>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Contactez-nous') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="max-w-4xl mx-auto">
                        <div class="text-center mb-12">
                            <h1 class="text-4xl font-bold text-gray-900 mb-4">Contactez notre équipe</h1>
                            <p class="text-xl text-gray-600">
                                Nous sommes là pour répondre à toutes vos questions
                            </p>
                        </div>

                        <div class="grid md:grid-cols-2 gap-12">
                            <!-- Formulaire de contact -->
                            <div>
                                <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6">
                                    @csrf
                                    
                                    <div>
                                        <label for="name" class="block text-sm font-medium text-gray-700">Votre nom</label>
                                        <div class="mt-1">
                                            <input type="text" name="name" id="name" value="{{ old('name', auth()->check() ? auth()->user()->name : '') }}" required
                                                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                        </div>
                                        @error('name')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="email" class="block text-sm font-medium text-gray-700">Votre email</label>
                                        <div class="mt-1">
                                            <input type="email" name="email" id="email" value="{{ old('email', auth()->check() ? auth()->user()->email : '') }}" required
                                                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                        </div>
                                        @error('email')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="subject" class="block text-sm font-medium text-gray-700">Sujet</label>
                                        <div class="mt-1">
                                            <select name="subject" id="subject" required
                                                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                                <option value="" disabled selected>Sélectionnez un sujet</option>
                                                <option value="question" {{ old('subject') == 'question' ? 'selected' : '' }}>Question générale</option>
                                                <option value="support" {{ old('subject') == 'support' ? 'selected' : '' }}>Support technique</option>
                                                <option value="billing" {{ old('subject') == 'billing' ? 'selected' : '' }}>Facturation</option>
                                                <option value="partnership" {{ old('subject') == 'partnership' ? 'selected' : '' }}>Partenariat</option>
                                                <option value="other" {{ old('subject') == 'other' ? 'selected' : '' }}>Autre</option>
                                            </select>
                                        </div>
                                        @error('subject')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="message" class="block text-sm font-medium text-gray-700">Votre message</label>
                                        <div class="mt-1">
                                            <textarea name="message" id="message" rows="4" required
                                                class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">{{ old('message') }}</textarea>
                                        </div>
                                        @error('message')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="flex items-center">
                                        <button type="submit"
                                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            Envoyer le message
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <!-- Informations de contact -->
                            <div class="space-y-8">
                                <div>
                                    <h3 class="text-lg font-medium text-gray-900 mb-4">Nos coordonnées</h3>
                                    <div class="space-y-4">
                                        <div class="flex items-start">
                                            <div class="flex-shrink-0">
                                                <svg class="h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                </svg>
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-base text-gray-700">
                                                    123 Rue de la République<br>
                                                    75001 Paris, France
                                                </p>
                                            </div>
                                        </div>

                                        <div class="flex items-start">
                                            <div class="flex-shrink-0">
                                                <svg class="h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                                </svg>
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-base text-gray-700">
                                                    +33 1 23 45 67 89
                                                </p>
                                                <p class="text-sm text-gray-500">Lun-Ven, 9h-18h</p>
                                            </div>
                                        </div>

                                        <div class="flex items-start">
                                            <div class="flex-shrink-0">
                                                <svg class="h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-base text-gray-700">
                                                    contact@freelance-platform.com
                                                </p>
                                                <p class="text-sm text-gray-500">Réponse sous 24h</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <h3 class="text-lg font-medium text-gray-900 mb-4">Suivez-nous</h3>
                                    <div class="flex space-x-6">
                                        <a href="#" class="text-gray-400 hover:text-gray-500">
                                            <span class="sr-only">Facebook</span>
                                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                                <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                                            </svg>
                                        </a>
                                        <a href="#" class="text-gray-400 hover:text-gray-500">
                                            <span class="sr-only">Twitter</span>
                                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                                            </svg>
                                        </a>
                                        <a href="#" class="text-gray-400 hover:text-gray-500">
                                            <span class="sr-only">LinkedIn</span>
                                            <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>

                                <div class="bg-gray-50 p-6 rounded-lg">
                                    <h3 class="text-lg font-medium text-gray-900 mb-2">FAQ</h3>
                                    <p class="text-sm text-gray-600 mb-4">
                                        Consultez notre foire aux questions pour trouver rapidement des réponses aux questions les plus courantes.
                                    </p>
                                    <a href="#" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                                        Voir la FAQ <span aria-hidden="true">→</span>
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
