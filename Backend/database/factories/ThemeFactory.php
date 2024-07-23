<?php

namespace Database\Factories;

use App\Models\Theme;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ThemeFactory extends Factory
{
    protected $model = Theme::class;

    public function definition()
    {
        $category = Category::inRandomOrder()->first();

        $themesByCategory = [
            'Culture Générale' => [
                'Trivia divers', 'Faits insolites', 'Culture populaire'
            ],
            'Sciences' => [
                'Physique', 'Chimie', 'Biologie'
            ],
            'Histoire' => [
                'Guerres mondiales', 'Rois et reines', 'Événements majeurs'
            ],
            'Géographie' => [
                'Capitale du monde', 'Pays et continents', 'Relief et climat'
            ],
            'Sports' => [
                'Football', 'Olympiques', 'Records sportifs'
            ],
            'Divertissement' => [
                'Cinéma', 'Séries télé', 'Jeux vidéo'
            ],
            'Art' => [
                'Peinture', 'Sculpture', 'Architecture'
            ],
            'Littérature' => [
                'Romans célèbres', 'Auteurs', 'Poésie'
            ],
            'Technologie' => [
                'Innovations', 'Gadgets', 'Histoire de la technologie'
            ],
            'Musique' => [
                'Genres musicaux', 'Instruments', 'Artistes célèbres'
            ]
        ];

        $categoryThemes = $themesByCategory[$category->name] ?? ['Thème générique'];

        return [
            'name' => $this->faker->randomElement($categoryThemes),
            'description' => $this->faker->sentence,
            'public' => $this->faker->boolean,
            'user_id' => User::factory(), // Crée un utilisateur fictif et l'associe au thème
            'category_id' => $category->id, // Associe le thème à une catégorie existante
        ];
    }
}
