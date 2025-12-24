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
        Schema::create('inmates', function (Blueprint $table) {
            $table->id();
            $table->string('registration_number')->unique();
            $table->string('name');
            $table->string('place_of_birth');
            $table->date('date_of_birth');
            $table->enum('gender', ['Laki-laki', 'Perempuan']);
            $table->string('religion');
            $table->string('education_level')->nullable();
            $table->string('last_job')->nullable();
            $table->string('crime_type');
            $table->integer('sentence_length_months'); // Lama pidana dalam bulan
            $table->integer('remaining_sentence_months'); // Sisa pidana dalam bulan
            $table->integer('recidivism_count')->default(0); // Jumlah residivisme
            $table->text('health_notes')->nullable();
            $table->string('training_attended')->nullable();
            $table->string('work_program')->nullable();
            $table->foreignId('prison_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['active', 'released', 'transferred'])->default('active');
            $table->date('entry_date');
            $table->date('release_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inmates');
    }
};
