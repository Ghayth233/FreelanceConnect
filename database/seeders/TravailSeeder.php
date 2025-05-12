<?php

namespace Database\Seeders;

use App\Models\Travail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TravailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $travaux = [
            [
                'titre' => 'Développement site web e-commerce',
                'description' => 'Création d\'un site e-commerce avec paiement en ligne et gestion des stocks.',
                'budget' => 2500,
                'categorie' => 'Développement Web',
                'date_limite' => Carbon::now()->addDays(30)->toDateTimeString(),
                'statut' => 'disponible',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titre' => 'Design logo entreprise',
                'description' => 'Création d\'une identité visuelle pour une nouvelle marque de vêtements.',
                'budget' => 500,
                'categorie' => 'Design Graphique',
                'date_limite' => Carbon::now()->addDays(14)->toDateTimeString(),
                'statut' => 'disponible',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'titre' => 'Rédaction articles de blog',
                'description' => 'Rédaction de 10 articles sur les tendances du marketing digital en 2025.',
                'budget' => 300,
                'categorie' => 'Rédaction',
                'date_limite' => Carbon::now()->addDays(7)->toDateTimeString(),
                'statut' => 'disponible',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($travaux as $travail) {
            Travail::create($travail);
        }
    }
}
