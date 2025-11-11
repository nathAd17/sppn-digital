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
        Schema::create('assessments_scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('assessment_id')->constrained()->onDelete('cascade');
            $table->string('variable'); // pembinaan_kepribadian, dll
            $table->string('aspect'); // Kesadaran Beragama, dll
            $table->decimal('score', 5, 2);
            $table->decimal('weight', 5, 2);
            $table->decimal('weighted_score', 5, 2);
            $table->string('category')->nullable(); // Sangat Baik, Baik, dll
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessments_scores');
    }
};
