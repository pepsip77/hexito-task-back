<?php

namespace App\Providers;

use App\Services\CryptoConverter\ConversionServices\ConversionService;
use App\Services\CryptoConverter\CryptoConverter;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class CryptoConverterProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register services.
     *
     * @return void
     * @throws BindingResolutionException
     */
    public function register(): void
    {
        $this->app->singleton(
            CryptoConverter::class,
            fn ($app) => new CryptoConverter($this->app->make(ConversionService::class))
        );
    }
}
