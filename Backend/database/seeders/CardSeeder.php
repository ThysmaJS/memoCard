<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Card;
use App\Models\Theme;

class CardSeeder extends Seeder
{
    public function run()
    {
        // Génère des cartes pour chaque thème
        $themes = Theme::all();

        foreach ($themes as $theme) {
            Card::factory()->count(5)->create(['theme_id' => $theme->id]);
        }
    }
}
