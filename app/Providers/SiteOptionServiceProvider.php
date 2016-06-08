<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class SiteOptionServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind('SiteOption', function()
        {
            return new \App\Awesome\Facades\SiteOption\SiteOptionImpl;
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // foreach (glob(app_path().'/Helpers/*.php') as $filename)
        // {
        //     require_once($filename);
        // }
    }
}
