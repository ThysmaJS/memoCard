<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // mot de passe par défaut
            'remember_token' => Str::random(10),
            'daily_reminder' => $this->faker->boolean,
            'review_level' => $this->faker->numberBetween(0, 5),
        ];
    }
}
