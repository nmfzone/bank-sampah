<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\ValidatorExtended;

class ValidationExtensionServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->validator->resolver(function($translator, $data, $rules, $messages = [], $customAttributes = []) {
            return new ValidatorExtended($translator, $data, $rules, $messages, $customAttributes);
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
