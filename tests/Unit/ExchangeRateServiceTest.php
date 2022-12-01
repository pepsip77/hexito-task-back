<?php

use App\Enums\AcceptedCurrency;
use App\Exceptions\CryptoConverterException;
use App\Services\CryptoConverter\ConversionServices\ConversionService;
use App\Services\CryptoConverter\ConversionServices\ExchangeRateService;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ExchangeRateServiceTest extends TestCase
{
    private ConversionService $service;
    private float $amount;
    private string $currencyFrom;
    private string $currencyTo;

    public function setUp(): void
    {
        parent::setUp();

        $this->service = new ExchangeRateService();

        $this->amount = 100.17;
        $this->currencyFrom = AcceptedCurrency::EUR->value;
        $this->currencyTo = 'BTC';
    }

    /**
     * @test
     */
    public function convertFunctionFailsWhenResponseIsNotSuccessful(): void
    {
        Http::fake(['*' => Http::response([], 400)]);

        $this->expectException(CryptoConverterException::class);

        $this->service->convert($this->amount, $this->currencyFrom, $this->currencyTo);
    }

    /**
     * @test
     */
    public function convertFunctionFailsWhenResponseHasNoResult(): void
    {
        Http::fake(['*' => Http::response([], 200)]);

        $this->expectException(CryptoConverterException::class);

        $this->service->convert($this->amount, $this->currencyFrom, $this->currencyTo);
    }

    /**
     * @test
     */
    public function convertFunctionReturnsResultFromResponse(): void
    {
        $expectedResult = 0.14;

        Http::fake(['*' => Http::response(['result' => $expectedResult], 200)]);

        $result = $this->service->convert($this->amount, $this->currencyFrom, $this->currencyTo);

        $this->assertEquals($expectedResult, $result);
    }
}
