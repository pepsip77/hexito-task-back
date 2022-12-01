<?php

namespace App\Services\CryptoConverter;

use App\Models\CryptoCalculation;
use App\Services\CryptoConverter\ConversionServices\ConversionService;

class CryptoConverterService
{
    public function __construct(private readonly ConversionService $conversionService)
    {
    }

    public function convert(float $amount, string $currencyFrom, string $currencyTo): float
    {
        $result = $this->conversionService->convert($amount, $currencyFrom, $currencyTo);

        CryptoCalculation::create([
            'amount' => $amount,
            'currency_from' => $currencyFrom,
            'currency_to' => $currencyTo,
            'result' => $result,
        ]);

        return $result;
    }
}
