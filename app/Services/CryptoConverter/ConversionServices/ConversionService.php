<?php

namespace App\Services\CryptoConverter\ConversionServices;

interface ConversionService
{
    public function convert(float $amount, string $currencyFrom, string $currencyTo): float;
}
