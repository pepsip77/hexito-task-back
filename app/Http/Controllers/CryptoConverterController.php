<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConvertRequest;
use App\Services\CryptoConverter\ConversionServices\ConversionService;
use Illuminate\Http\JsonResponse;

class CryptoConverterController extends Controller
{
    public function __construct(private readonly ConversionService $conversionService)
    {
    }

    public function convert(ConvertRequest $request): JsonResponse
    {
        $result = $this->conversionService
            ->convert($request['amount'], $request['currencyFrom'], $request['currencyTo']);

        return response()->json([
            'result' => $result,
        ]);
    }
}
