<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('airlines', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained('users')->cascadeOnDelete();
            $table->unsignedTinyInteger('world_id')->comment('World ID (1, 2, 3, etc.)');
            $table->string('airline_name', 100); // Batasi panjang untuk performa index
            $table->integer('day_game')->default(1);
            $table->datetime('next_day_change')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            // Indexes untuk performa
            $table->index(['world_id', 'is_active']); // Query berdasarkan world dan status
            $table->index('user_id'); // Query berdasarkan user

            // Unique constraints
            $table->unique(['user_id', 'world_id'], 'unique_user_world'); // 1 user = 1 airline per world
            $table->unique(['world_id', 'airline_name'], 'unique_airline_per_world'); // airline_name unik per world
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('airlines');
    }
};
