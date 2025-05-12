@extends('layouts.app')

@section('title', 'Accueil - FreelanceConnect')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    /* Hero Section */
    .hero-section {
        @apply bg-gradient-to-r from-blue-600 to-blue-700 text-white py-24;
        background-image: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
    }
    
    .hero-container {
        @apply max-w-7xl mx-auto px-6 lg:px-8;
    }
    
    .hero-content {
        @apply text-center max-w-4xl mx-auto;
    }
    
    .hero-title {
        @apply text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight;
        text-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .hero-subtitle {
        @apply text-xl md:text-2xl mb-10 text-blue-100 leading-relaxed;
    }
    
    .hero-buttons {
        @apply flex flex-col sm:flex-row justify-center gap-4;
    }
    
    /* Features Section */
    .features-section {
        @apply py-20 bg-white;
    }
    
    .section-header {
        @apply text-center mb-16;
    }
    
    .section-title {
        @apply text-3xl font-bold text-gray-900 mb-4;
    }
    
    .section-divider {
        @apply w-20 h-1 bg-blue-600 mx-auto;
    }
    
    .feature-card {
        @apply bg-white rounded-xl shadow-lg p-8 hover:shadow-xl transition-all duration-300 border border-gray-100;
    }
    
    .feature-icon {
        @apply w-16 h-16 rounded-full flex items-center justify-center text-2xl mb-6 mx-auto;
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        color: white;
        box-shadow: 0 4px 6px -1px rgba(37, 99, 235, 0.3);
    }
    
    /* How It Works Section */
    .steps-section {
        @apply py-20 bg-gray-50;
    }
    
    .step-card {
        @apply relative pb-8 text-center;
    }
    
    .step-number {
        @apply w-14 h-14 rounded-full bg-blue-600 text-white flex items-center justify-center text-xl font-bold mb-6 mx-auto;
        box-shadow: 0 4px 6px -1px rgba(37, 99, 235, 0.3);
    }
    
    /* Categories Section */
    .categories-section {
        @apply py-20 bg-white;
    }
    
    .category-card {
        @apply rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2;
    }
    
    .category-image {
        @apply w-full h-48 object-cover;
    }
    
    .category-content {
        @apply p-6 bg-white;
    }
    
    /* Testimonials Section */
    .testimonials-section {
        @apply py-20 bg-gray-50;
    }
    
    .testimonial-card {
        @apply bg-white p-8 rounded-xl shadow-md h-full;
    }
    
    .testimonial-avatar {
        @apply w-20 h-20 rounded-full mx-auto mb-6 border-4 border-white shadow-lg;
    }
    
    .testimonial-rating {
        @apply text-yellow-400 text-lg mb-4;
    }
    
    /* CTA Section */
    .cta-section {
        @apply py-20 bg-gradient-to-r from-blue-600 to-blue-700 text-center text-white;
        background-image: linear-gradient(135deg, #2563eb 0%, #1e40af 100%);
    }
    
    /* Buttons */
    .btn-primary {
        @apply inline-flex items-center px-8 py-3.5 border border-transparent rounded-lg shadow-lg text-lg font-semibold text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 transition-all duration-300;
    }
    
    .btn-secondary {
        @apply inline-flex items-center px-8 py-3.5 border border-transparent rounded-lg shadow-lg text-lg font-semibold text-blue-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-4 focus:ring-gray-300 transition-all duration-300;
    }
    
    .btn-outline-white {
        @apply inline-flex items-center px-8 py-3.5 border-2 border-white rounded-lg shadow-lg text-lg font-semibold text-white hover:bg-white hover:text-blue-700 focus:outline-none focus:ring-4 focus:ring-white/50 transition-all duration-300;
    }
</style>
@endpush

@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-container">
            <div class="hero-content">
                <h1 class="hero-title">
                    Trouvez les meilleurs talents freelances pour vos projets
                </h1>
                <p class="hero-subtitle">
                    Connectez-vous avec des professionnels qualifiés dans divers domaines et concrétisez vos idées avec une plateforme simple et sécurisée
                </p>
    
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="section-header">
                <h2 class="section-title">Pourquoi choisir FreelanceConnect ?</h2>
                <div class="section-divider"></div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <h3 class="text-xl font-bold text-center mb-4 text-gray-900">Rapide et efficace</h3>
                    <p class="text-gray-600 text-center leading-relaxed">
                        Trouvez le professionnel idéal en quelques minutes grâce à notre système de matching intelligent et nos filtres avancés.
                    </p>
                </div>
                
                <!-- Feature 2 -->
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3 class="text-xl font-bold text-center mb-4 text-gray-900">Sécurisé et fiable</h3>
                    <p class="text-gray-600 text-center leading-relaxed">
                        Paiement sécurisé, gestion de projet intégrée et système d'évaluation transparent pour une collaboration en toute confiance.
                    </p>
                </div>
                
                <!-- Feature 3 -->
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="text-xl font-bold text-center mb-4 text-gray-900">Large communauté</h3>
                    <p class="text-gray-600 text-center leading-relaxed">
                        Accédez à plus de 50 000 professionnels qualifiés dans plus de 200 domaines d'expertise différents.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="steps-section">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="section-header">
                <h2 class="section-title">Comment ça marche ?</h2>
                <div class="section-divider"></div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Step 1 -->
                <div class="step-card">
                    <div class="step-number">1</div>
                    <h3 class="text-xl font-bold text-center mb-4 text-gray-900">Créez votre projet</h3>
                    <p class="text-gray-600 text-center leading-relaxed">
                        Décrivez votre besoin en quelques minutes. Notre formulaire intuitif vous guide pas à pas.
                    </p>
                </div>
                
                <!-- Step 2 -->
                <div class="step-card">
                    <div class="step-number">2</div>
                    <h3 class="text-xl font-bold text-center mb-4 text-gray-900">Recevez des propositions</h3>
                    <p class="text-gray-600 text-center leading-relaxed">
                        Comparez les profils, portfolios, avis et tarifs des freelances intéressés par votre projet.
                    </p>
                </div>
                
                <!-- Step 3 -->
                <div class="step-card">
                    <div class="step-number">3</div>
                    <h3 class="text-xl font-bold text-center mb-4 text-gray-900">Lancez votre projet</h3>
                    <p class="text-gray-600 text-center leading-relaxed">
                        Collaborez en toute sérénité avec notre espace de travail et outils de suivi intégrés.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="categories-section">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="section-header">
                <h2 class="section-title">Catégories populaires</h2>
                <div class="section-divider"></div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Category 1 -->
                <a href="{{ route('travaux.index') }}?categorie=Développement Web" class="category-card">
                    <img src="https://images.unsplash.com/photo-1461749280684-dccba630e2f6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80" 
                         alt="Développement Web" class="category-image">
                    <div class="category-content">
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Développement Web</h3>
                        <p class="text-gray-600 text-sm">Sites vitrines, e-commerce, applications web sur mesure</p>
                        <div class="mt-4 text-blue-600 text-sm font-medium">
                            Voir les offres <i class="fas fa-arrow-right ml-1"></i>
                        </div>
                    </div>
                </a>
                
                <!-- Category 2 -->
                <a href="{{ route('travaux.index') }}?categorie=Design Graphique" class="category-card">
                    <img src="https://images.unsplash.com/photo-1547658719-da2b51169166?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80" 
                         alt="Design Graphique" class="category-image">
                    <div class="category-content">
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Design Graphique</h3>
                        <p class="text-gray-600 text-sm">Identité visuelle, logos, supports print et digitaux</p>
                        <div class="mt-4 text-blue-600 text-sm font-medium">
                            Voir les offres <i class="fas fa-arrow-right ml-1"></i>
                        </div>
                    </div>
                </a>
                
                <!-- Category 3 -->
                <a href="{{ route('travaux.index') }}?categorie=Rédaction" class="category-card">
                    <img src="https://images.unsplash.com/photo-1455390582262-044c3d0dac82?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80" 
                         alt="Rédaction" class="category-image">
                    <div class="category-content">
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Rédaction</h3>
                        <p class="text-gray-600 text-sm">Articles de blog, contenus SEO, traductions, relecture</p>
                        <div class="mt-4 text-blue-600 text-sm font-medium">
                            Voir les offres <i class="fas fa-arrow-right ml-1"></i>
                        </div>
                    </div>
                </a>
                
                <!-- Category 4 -->
                <a href="{{ route('travaux.index') }}?categorie=Marketing Digital" class="category-card">
                    <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80" 
                         alt="Marketing Digital" class="category-image">
                    <div class="category-content">
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Marketing Digital</h3>
                        <p class="text-gray-600 text-sm">SEO, réseaux sociaux, emailing, campagnes publicitaires</p>
                        <div class="mt-4 text-blue-600 text-sm font-medium">
                            Voir les offres <i class="fas fa-arrow-right ml-1"></i>
                        </div>
                    </div>
                </a>
            </div>
            
            <div class="text-center mt-12">
                <a href="{{ route('travaux.index') }}" class="btn-primary">
                    <i class="fas fa-list mr-3"></i>
                    Explorer toutes les catégories
                </a>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials-section">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="section-header">
                <h2 class="section-title">Ils nous font confiance</h2>
                <div class="section-divider"></div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="testimonial-card">
                    <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="Client" class="testimonial-avatar">
                    <div class="text-center">
                        <h4 class="font-bold text-lg text-gray-900">Marie D.</h4>
                        <p class="text-blue-600 text-sm mb-4">Entrepreneure - Boutique en ligne</p>
                        <p class="text-gray-600 italic mb-4">
                            "J'ai trouvé un développeur exceptionnel pour mon site e-commerce. Le processus était simple et efficace. Je recommande vivement !"
                        </p>
                        <div class="testimonial-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
                
                <!-- Testimonial 2 -->
                <div class="testimonial-card">
                    <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="Client" class="testimonial-avatar">
                    <div class="text-center">
                        <h4 class="font-bold text-lg text-gray-900">Thomas L.</h4>
                        <p class="text-blue-600 text-sm mb-4">Responsable Marketing - Startup</p>
                        <p class="text-gray-600 italic mb-4">
                            "La qualité des freelances est au rendez-vous. J'ai pu constituer une équipe compétente pour mon projet en un temps record."
                        </p>
                        <div class="testimonial-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
                
                <!-- Testimonial 3 -->
                <div class="testimonial-card">
                    <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Client" class="testimonial-avatar">
                    <div class="text-center">
                        <h4 class="font-bold text-lg text-gray-900">Sophie M.</h4>
                        <p class="text-blue-600 text-sm mb-4">Chef de projet - Agence</p>
                        <p class="text-gray-600 italic mb-4">
                            "Une plateforme intuitive qui m'a permis de trouver rapidement les compétences dont j'avais besoin. Service client réactif et professionnel."
                        </p>
                        <div class="testimonial-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection