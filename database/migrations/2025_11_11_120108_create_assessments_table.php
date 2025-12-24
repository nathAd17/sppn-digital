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
        Schema::create('assessments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inmate_id')->constrained()->onDelete('cascade');
            $table->foreignId('prison_id')->constrained()->onDelete('cascade');
            $table->integer('month');
            $table->integer('year');
            $table->enum('status', ['draft', 'submitted', 'approved', 'rejected'])->default('draft');
            $table->text('notes')->nullable();
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('approved_by')->nullable()->constrained('users');
            $table->timestamp('submitted_at')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();

            // Skor per variabel
            $table->decimal('score_kepribadian', 5, 2)->nullable();
            $table->decimal('score_kemandirian', 5, 2)->nullable();
            $table->decimal('score_sikap', 5, 2)->nullable();
            $table->decimal('score_mental', 5, 2)->nullable();
            $table->decimal('total_score', 5, 2)->nullable();

            // Unique constraint untuk prevent duplicate assessment
            $table->unique(['inmate_id', 'month', 'year']);
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessments');
    }
};
