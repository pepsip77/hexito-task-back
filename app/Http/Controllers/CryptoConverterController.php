<?php

namespace App\Http\Controllers;

use App\Enums\AcceptedCurrency;
use App\Services\CryptoConverter\ConversionServices\ConversionService;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Enum;

class CryptoConverterController extends Controller
{
    /**
     * @throws BindingResolutionException
     */
    public function convert(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'currencyFrom' => [
                'required',
                new Enum(AcceptedCurrency::class)
            ],
            'currencyTo' => 'required',
        ]);

        $converter = app()->make(ConversionService::class);

        $result = $converter->convert($validated['amount'], $validated['currencyFrom'], $validated['currencyTo']);

        return response()->json([
            'result' => $result,
        ]);
    }
}
