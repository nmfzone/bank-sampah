<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// use Illuminate\Translation\TranslationServiceProvider as BaseTranslationServiceProvider;

use App\Services\MessagesTranslator;

class MessagesTranslationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton('App\Services\MessagesTranslator', function () {
            return new MessagesTranslator;
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
