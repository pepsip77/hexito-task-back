<?php

namespace App\Services\CryptoConverter\ConversionServices;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class ExchangeRateService implements ConversionService
{
    private const BASE_URL = 'https://api.exchangerate.host/convert';

    public function convert(float $amount, string $currencyFrom, string $currencyTo): float
    {
        $response = $this->getResponse($amount, $currencyFrom, $currencyTo);
        //@todo:check if response was successful
        $result = Arr::get($response->json(), 'result');
        //@todo: put everything to DB
        return $result;
    }

    public function getResponse(float $amount, string $currencyFrom, string $currencyTo): Response
    {
        return Http::get(self::BASE_URL, [
            'from' => $currencyFrom,
            'to' => $currencyTo,
            'amount' => $amount,
        ]);
    }
}
