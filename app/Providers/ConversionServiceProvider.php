<?php

namespace App\Providers;

use App\Services\CryptoConverter\ConversionServices\ConversionService;
use App\Services\CryptoConverter\ConversionServices\ExchangeRateService;
use Illuminate\Support\ServiceProvider;

class ConversionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        //currently the only conversion service supported
        $conversionService = new ExchangeRateService();
        $this->app->singleton(ConversionService::class, fn ($app) => $conversionService);
    }
}
