<?php

namespace App\Services\CryptoConverter;

use App\Services\CryptoConverter\ConversionServices\ConversionService;

class CryptoConverter
{
    private ConversionService $conversionProvider;

    public function __construct(ConversionService $conversionProvider)
    {
        $this->conversionProvider = $conversionProvider;
    }

    public function convert(float $amount, string $currencyFrom, string $currencyTo): float
    {
        return $this->conversionProvider->convert($amount, $currencyFrom, $currencyTo);
    }
}
