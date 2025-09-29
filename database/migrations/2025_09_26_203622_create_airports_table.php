<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('airports', function (Blueprint $table) {
            $table->id();
            $table->string('iata_code', 3)->unique();
            $table->string('icao_code', 4)->nullable();
            $table->string('name', 100);
            $table->string('city', 50)->nullable();
            $table->string('country', 50)->nullable();
            $table->decimal('latitude', 10, 6)->nullable();
            $table->decimal('longitude', 10, 6)->nullable();
            $table->timestamps();

            $table->index('country');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('airports');
    }
};
