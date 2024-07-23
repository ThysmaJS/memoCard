<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Crée un utilisateur spécifique
        User::create([
            'name' => 'Gary',
            'email' => 'gary@gary.com',
            'password' => Hash::make('gary'), // mot de passe hashé
            'daily_reminder' => false,
            'review_level' => 0,
        ]);

        // Crée 10 utilisateurs fictifs
        User::factory()->count(10)->create();
    }
}
