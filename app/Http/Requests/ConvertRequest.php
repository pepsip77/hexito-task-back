<?php

namespace App\Http\Requests;

use App\Enums\AcceptedCurrency;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class ConvertRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'amount' => 'required|numeric|min:0.01',
            'currencyFrom' => [
                'required',
                new Enum(AcceptedCurrency::class)
            ],
            'currencyTo' => 'required',
        ];
    }
}
