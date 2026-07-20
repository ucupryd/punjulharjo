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
        Schema::create('cemara_pohons', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pohon', 30)->unique();
            $table->foreignId('adopsi_id')->constrained('cemara_adopsis')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('nama_sertifikat');
            $table->string('jenis')->default('Cemara Laut (Casuarina equisetifolia)');
            $table->date('tanggal_tanam')->nullable();
            $table->decimal('lat', 10, 7)->nullable();
            $table->decimal('lng', 10, 7)->nullable();
            $table->string('lokasi_teks')->nullable();
            $table->enum('status', ['menunggu_tanam', 'ditanam', 'tumbuh', 'mati'])->default('menunggu_tanam');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cemara_pohons');
    }
};
