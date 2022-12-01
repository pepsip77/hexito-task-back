<?php

use App\Enums\AcceptedCurrency;
use App\Models\CryptoCalculation;
use App\Services\CryptoConverter\ConversionServices\ConversionService;
use App\Services\CryptoConverter\CryptoConverterService;
use Illuminate\Database\Eloquent\Builder;
use Tests\TestCase;

class CryptoConverterServiceTest extends TestCase
{
    private CryptoConverterService $service;
    private ConversionService $conversionService;
    private CryptoCalculation $model;

    public function setUp(): void
    {
        parent::setUp();

        $this->model = Mockery::mock(CryptoCalculation::class);
        $this->conversionService = $this->createMock(ConversionService::class);
        $this->service = new CryptoConverterService($this->model, $this->conversionService);
    }

    /**
     * @test
     */
    public function convertMethodCallsConversionServiceAndSaveDataAndReturnsResult(): void
    {
        $amount = 100.17;
        $currencyFrom = AcceptedCurrency::EUR->value;
        $currencyTo = 'BTC';
        $expectedResult = 0.44;

        $this->conversionService
            ->expects($this->once())
            ->method('convert')
            ->willReturn($expectedResult);

        $this->model
            ->shouldReceive('create')
            ->once();

        $result = $this->service->convert($amount, $currencyFrom, $currencyTo);

        $this->assertEquals($expectedResult, $result);
    }
}
