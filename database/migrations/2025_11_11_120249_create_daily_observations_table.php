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
        Schema::create('daily_observations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assessment_id')->constrained()->onDelete('cascade');
            $table->foreignId('observation_item_id')->constrained()->onDelete('cascade');
            $table->integer('day'); // 1-31
            $table->boolean('is_checked')->default(false);
            $table->text('notes')->nullable();
            $table->timestamps();
            // Unique constraint untuk prevent duplicate entry
            $table->unique(['assessment_id', 'observation_item_id', 'day']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_observations');
    }
};
