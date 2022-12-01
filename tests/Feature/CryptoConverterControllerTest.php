<?php

use App\Enums\AcceptedCurrency;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class CryptoConverterControllerTest extends TestCase
{
    /**
     * @test
     */
    public function convertMethodShouldReturnSuccessfulResponseWithResult(): void
    {
        $amount = 100.17;
        $currencyFrom = AcceptedCurrency::EUR->value;
        $currencyTo = 'BTC';

        $response = $this->json('get','api/convert', [
            'amount' => $amount,
            'currencyFrom' => $currencyFrom,
            'currencyTo' => $currencyTo,
        ]);

        $response->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) => $json->has('result'));
    }

    /**
     * @test
     */
    public function convertMethodShouldReturnValidationErrorWhenInputsAreMissing(): void
    {
        $response = $this->json('get', 'api/convert', []);

        $response->assertStatus(422)
            ->assertJson(
                fn (AssertableJson $json) => $json->has('message')
                    ->has('errors.amount')
                    ->has('errors.currencyFrom')
                    ->has('errors.currencyTo')
            );
    }
}
