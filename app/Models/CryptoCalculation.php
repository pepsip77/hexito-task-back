<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CryptoCalculation extends Model
{
    protected $fillable = [
        'amount',
        'currency_from',
        'currency_to',
        'result',
    ];
}
