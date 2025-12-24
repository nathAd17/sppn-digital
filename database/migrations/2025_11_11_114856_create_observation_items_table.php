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
        Schema::create('observation_items', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // ka1, kh1, kr1, dll
            $table->enum('variable', [
                'pembinaan_kepribadian',
                'pembinaan_kemandirian',
                'sikap',
                'kondisi_mental'
            ]);
            $table->string('aspect'); // Kesadaran Beragama, Agresi, dll
            $table->decimal('aspect_weight', 5, 2); // Bobot aspek
            $table->string('item_name');
            $table->integer('monthly_frequency'); // Frekuensi per bulan (1-31)
            $table->decimal('item_weight', 5, 2)->default(1); // Bobot item dalam aspek
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('observation_items');
    }
};
