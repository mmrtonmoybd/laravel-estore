<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->singleton(\Parsedown::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        //Schema::defaultStringLength(191);
        //$seoimagelink = asset('image');
    }
}
