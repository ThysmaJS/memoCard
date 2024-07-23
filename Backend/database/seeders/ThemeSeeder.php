<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Theme;
use App\Models\Category;

class ThemeSeeder extends Seeder
{
    public function run()
    {
        $themesByCategory = [
            'Culture Générale' => ['Trivia divers', 'Faits insolites', 'Culture populaire'],
            'Sciences' => ['Physique', 'Chimie', 'Biologie'],
            'Histoire' => ['Guerres mondiales', 'Rois et reines', 'Événements majeurs'],
            'Géographie' => ['Capitale du monde', 'Pays et continents', 'Relief et climat'],
            'Sports' => ['Football', 'Olympiques', 'Records sportifs'],
            'Divertissement' => ['Cinéma', 'Séries télé', 'Jeux vidéo'],
            'Art' => ['Peinture', 'Sculpture', 'Architecture'],
            'Littérature' => ['Romans célèbres', 'Auteurs', 'Poésie'],
            'Technologie' => ['Innovations', 'Gadgets', 'Histoire de la technologie'],
            'Musique' => ['Genres musicaux', 'Instruments', 'Artistes célèbres'],
        ];

        foreach ($themesByCategory as $categoryName => $themes) {
            $category = Category::where('name', $categoryName)->first();

            if ($category) {
                foreach ($themes as $theme) {
                    Theme::create([
                        'name' => $theme,
                        'description' => 'Description for ' . $theme,
                        'public' => true,
                        'user_id' => 1, // Remplacez par un ID d'utilisateur valide
                        'category_id' => $category->id,
                    ]);
                }
            }
        }
    }
}
