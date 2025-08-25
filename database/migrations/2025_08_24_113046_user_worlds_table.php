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
        //
        Schema::create('user_worlds', function (Blueprint $table) {
            $table->id();
            $table->foreignUuId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('world_id')->constrained('game_worlds')->cascadeOnDelete();
            $table->decimal('money', 15, 2)->default(0);
            $table->timestamps();

            $table->unique(['user_id', 'world_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
