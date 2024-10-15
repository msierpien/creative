<?php

namespace App\Providers;

use Roots\Acorn\Sage\SageServiceProvider;
use App\View\Components\FeaturedProducts;
use App\View\Components\FeaturedText;
use App\View\Components\Button;
use Illuminate\Support\Facades\Blade;

class ThemeServiceProvider extends SageServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        parent::register();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        Blade::component('featured-products', FeaturedProducts::class);
        Blade::component('featured-text', FeaturedText::class);
        Blade::component('button', Button::class);
    }
}
