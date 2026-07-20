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
        Schema::create('cemara_adopsis', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi', 30)->unique();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('paket_id')->constrained('cemara_pakets')->restrictOnDelete();
            $table->string('nama_pemesan');
            $table->string('nama_sertifikat');
            $table->string('telepon', 30)->nullable();
            $table->unsignedInteger('jumlah')->default(1);
            $table->unsignedBigInteger('total_harga');
            $table->string('metode_bayar')->default('transfer_manual');
            $table->string('bukti_bayar')->nullable();
            $table->enum('status', [
                'menunggu_pembayaran',
                'menunggu_verifikasi',
                'diverifikasi',
                'ditolak',
                'ditanam',
                'selesai'
            ])->default('menunggu_pembayaran');
            $table->text('catatan_admin')->nullable();
            $table->timestamp('dibayar_at')->nullable();
            $table->timestamp('diverifikasi_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cemara_adopsis');
    }
};
