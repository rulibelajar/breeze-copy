<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_world_1', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('airline_name');
            $table->integer('day_game')->default(1);
            $table->datetime('next_day_change')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->unique('user_id');
            $table->unique('airline_name');
        });

        Schema::create('user_world_2', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('airline_name');
            $table->integer('day_game')->default(1);
            $table->datetime('next_day_change')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->unique('user_id');
            $table->unique('airline_name');
        });

        Schema::create('user_world_3', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('airline_name');
            $table->integer('day_game')->default(1);
            $table->datetime('next_day_change')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->unique('user_id');
            $table->unique('airline_name');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_world_1');
        Schema::dropIfExists('user_world_2');
        Schema::dropIfExists('user_world_3');
    }
};
