<?php

namespace Courses\Providers;

use Illuminate\Support\ServiceProvider;

class CourseServiceProvider extends ServiceProvider
{
    /**
     * Register any application service
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application service
     *
     * @return void
     */
    public function boot()
    {
        $modulName = strtolower(basename(dirname(__DIR__, 1)));
        
        // Load Migrations
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        // Load Translations
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', $modulName);
    }
}