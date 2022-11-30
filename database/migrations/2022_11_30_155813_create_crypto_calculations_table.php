<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('crypto_calculations', function (Blueprint $table) {
            $table->id();
            $table->float('amount');
            $table->string('currency_from', 3);
            $table->string('currency_to', 3);
            $table->float('result', 16, 8);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('crypto_calculations');
    }
};
