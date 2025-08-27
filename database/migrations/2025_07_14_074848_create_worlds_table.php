<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_world_1', function (Blueprint $table) {
            $table->id();
            $table->foreignUuId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('airline_name');
            $table->integer('day_game')->default(1); // Hari game saat ini (1-90)
            $table->datetime('next_day_change')->nullable(); // Kapan hari akan berganti lagi
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            // 1 user = 1 airline per world
            $table->unique('user_id');
            // Airline name unique dalam world 1 saja
            $table->unique('airline_name');
        });

        Schema::create('user_world_2', function (Blueprint $table) {
            $table->id();
            $table->foreignUuId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('airline_name');
            $table->integer('day_game')->default(1); // Hari game saat ini (1-90)
            $table->datetime('next_day_change')->nullable(); // Kapan hari akan berganti lagi
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            // 1 user = 1 airline per world
            $table->unique('user_id');
            // Airline name unique dalam world 1 saja
            $table->unique('airline_name');
        });

        Schema::create('user_world_3', function (Blueprint $table) {
            $table->id();
            $table->foreignUuId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('airline_name');
            $table->integer('day_game')->default(1); // Hari game saat ini (1-90)
            $table->datetime('next_day_change')->nullable(); // Kapan hari akan berganti lagi
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            // 1 user = 1 airline per world
            $table->unique('user_id');
            // Airline name unique dalam world 1 saja
            $table->unique('airline_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_world_1');
        Schema::dropIfExists('user_world_2');
        Schema::dropIfExists('user_world_3');
    }
};
