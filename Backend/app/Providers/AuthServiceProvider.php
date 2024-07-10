<?php

namespace App\Providers;

use App\Models\Card;
use App\Models\Theme;
use App\Models\Review;
use App\Models\Category;
use App\Policies\CardPolicy;
use App\Policies\ThemePolicy;
use App\Policies\ReviewPolicy;
use App\Policies\CategoryPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        // Enregistrement de la policy
        Category::class => CategoryPolicy::class,
        Theme::class => ThemePolicy::class,
        Card::class => CardPolicy::class,
        Review::class => ReviewPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();

        // Autres Gates si nécessaire
    }
}
