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
        Schema::create('cemara_monitorings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pohon_id')->constrained('cemara_pohons')->cascadeOnDelete();
            $table->date('tanggal');
            $table->unsignedInteger('tinggi_cm')->nullable();
            $table->unsignedInteger('jumlah_daun')->nullable();
            $table->string('foto')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cemara_monitorings');
    }
};
