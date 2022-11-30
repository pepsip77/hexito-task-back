<?php

namespace App\Services\CryptoConverter\ConversionServices;

use App\Exceptions\CryptoConverterException;
use App\Models\CryptoCalculation;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class ExchangeRateService implements ConversionService
{
    private const BASE_URL = 'https://api.exchangerate.host/convert';

    /**
     * @throws CryptoConverterException
     */
    public function convert(float $amount, string $currencyFrom, string $currencyTo): float
    {
        $response = $this->getResponse($amount, $currencyFrom, $currencyTo);

        if (!$response->successful()) {
            throw new CryptoConverterException();
        }

        $result = $response->json('result');

        if (is_null($result)) {
            throw new CryptoConverterException();
        }

        CryptoCalculation::create([
            'amount' => $amount,
            'currency_from' => $currencyFrom,
            'currency_to' => $currencyTo,
            'result' => $result,
        ]);

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
