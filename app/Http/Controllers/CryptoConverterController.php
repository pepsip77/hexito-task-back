<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConvertRequest;
use App\Services\CryptoConverter\CryptoConverterService;
use Illuminate\Http\JsonResponse;

class CryptoConverterController extends Controller
{
    public function __construct(private readonly CryptoConverterService $service)
    {
    }

    public function convert(ConvertRequest $request): JsonResponse
    {
        $result = $this->service
            ->convert($request['amount'], $request['currencyFrom'], $request['currencyTo']);

        return response()->json([
            'result' => $result,
        ]);
    }
}
