<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CryptoConverterException extends Exception
{
    public function render(Request $request): Response
    {
        return response(['message' => 'Crypto conversion failed. Please check your inputs and try again'], 400);
    }
}
