<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition()
    {
        return [
            'name' => $this->faker->randomElement([
                'Culture Générale',
                'Sciences',
                'Histoire',
                'Géographie',
                'Sports',
                'Divertissement',
                'Art',
                'Littérature',
                'Technologie',
                'Musique'
            ]),
            'description' => $this->faker->sentence,
            'user_id' => User::factory(), // Crée un utilisateur fictif et l'associe à la catégorie
        ];
    }
}
