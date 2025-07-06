<?php

namespace Foxen\LaravelValidationErrorLogger;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/validation-error-logger.php' => config_path('validation-error-logger.php'),
        ], 'config');
    }

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/validation-error-logger.php', 'validation-error-logger'
        );
    }
}
