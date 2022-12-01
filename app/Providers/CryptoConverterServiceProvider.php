<?php

namespace App\Providers;

use App\Models\CryptoCalculation;
use App\Services\CryptoConverter\ConversionServices\ConversionService;
use App\Services\CryptoConverter\CryptoConverterService;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class CryptoConverterServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register services.
     *
     * @return void
     * @throws BindingResolutionException
     */
    public function register(): void
    {
        $model = $this->app->make(CryptoCalculation::class);
        $conversionService = $this->app->make(ConversionService::class);

        $this->app->singleton(
            CryptoConverterService::class,
            fn ($app) => new CryptoConverterService($model, $conversionService)
        );
    }
}
