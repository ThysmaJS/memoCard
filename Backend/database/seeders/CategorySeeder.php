<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        // Définir explicitement les 10 catégories
        $categories = [
            'Culture Générale',
            'Sciences',
            'Histoire',
            'Géographie',
            'Sports',
            'Divertissement',
            'Art',
            'Littérature',
            'Technologie',
            'Musique',
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
                'description' => 'Description for ' . $category,
                'user_id' => 1, // Remplacez par un ID d'utilisateur valide
            ]);
        }
    }
}
