FreelanceConnect
📌 Description du Projet
FreelanceConnect est une application web développée exclusivement avec Laravel, conçue pour mettre en relation des freelances qualifiés avec des clients à la recherche de talents. Le but est de simplifier le processus de publication d'offres et de candidatures dans un environnement clair, rapide et intuitif.

🚀 Fonctionnalités Principales
Gestion des Offres : Création, affichage et recherche d'offres de mission.

Candidature aux Offres : Les freelances peuvent postuler directement.

Profils Utilisateurs : Vue complète des informations du freelance ou du client.

Tableau de Bord : Accès rapide aux informations et actions clés.

Système de Notification (Laravel Notification) : Pour tenir les utilisateurs informés en temps réel.

🛠 Technologies Utilisées
Backend & Frontend Unifiés (Full Laravel Stack)


PHP 8.1+

MySQL 8.0+

Blade (Moteur de template Laravel)

Tailwind CSS (intégré dans les vues Blade)

Outils Complémentaires
Composer

NPM (pour la compilation des assets Laravel Mix)

Laravel Artisan

Git

🔧 Installation et Configuration
Prérequis
PHP 8.1+

Composer

Node.js 16+

MySQL 8.0+

Étapes d'Installation
bash
Copier
Modifier
# 1. Cloner le dépôt
git clone https://github.com/votre-username/freelanceconnect.git
cd freelanceconnect

# 2. Installer les dépendances PHP
composer install

# 3. Installer les dépendances front-end (pour Tailwind CSS)
npm install && npm run dev

# 4. Configurer l'environnement
cp .env.example .env
php artisan key:generate

# 5. Lancer les migrations
php artisan migrate --seed
📁 Structure du Projet
bash
Copier
Modifier
freelanceconnect/
├── app/                # Logique métier Laravel (Models, Controllers, etc.)
├── resources/views/    # Fichiers Blade (frontend)
├── routes/web.php      # Définition des routes web
├── database/           # Migrations et Seeders
├── public/             # Fichiers accessibles publiquement (assets)
├── config/             # Configurations Laravel
└── tests/              # Tests unitaires
🔐 Sécurité
Middleware Laravel pour l’authentification

Protection CSRF par défaut

Validation robuste des formulaires via FormRequest

Hashage des mots de passe via bcrypt

Accès restreint via politiques (Gate, Policy)

🧩 Modèles de Données
User : Client ou Freelance (type différencié par rôle)

Travail : Offre de mission

Candidature : Proposition d’un freelance pour une mission

🚀 Développement
bash
Copier
Modifier
# Créer une branche
git checkout -b feature/nom-fonctionnalite

# Commit avec message clair
git commit -m "Ajout: nouvelle fonctionnalité de publication"

# Pousser la branche
git push origin feature/nom-fonctionnalite
📈 Prochaines Étapes
 Intégration d'un tableau de bord analytique

 Système de messagerie interne

 Ajout de rôles avancés (Admin, Super Admin)

 Paiements simulés (mode sandbox)

🤝 Contribution
Fork du projet

Créer votre branche de fonctionnalité

Faire vos modifications

Ouvrir une Pull Request

📄 Licence
Ce projet est sous licence MIT. Voir le fichier LICENSE pour plus d’informations.

📬 Contact
Développeur principal
📧 Email : contact@freelanceconnect.com
🌐 Site Web : www.freelanceconnect.com

Développé avec Laravel ❤️ – Projet académique/individuel

