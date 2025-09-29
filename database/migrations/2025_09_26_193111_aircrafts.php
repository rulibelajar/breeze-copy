<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('aircrafts', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('airline_id')->nullable()->constrained('airlines')->cascadeOnDelete();

            $table->string('aircraft_name', 100); // contoh: Boeing 737-800
            $table->string('manufacturer', 30)->nullable(); // contoh: Boeing
            $table->unsignedSmallInteger('capacity')->default(0)->comment('Jumlah kursi');
            $table->unsignedInteger('range_km')->nullable()->comment('Jarak tempuh maksimal');

            $table->boolean('is_active')->default(true);
            $table->timestamps();

            // Indexes
            $table->index(['airline_id', 'is_active']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aircrafts');
    }
};
