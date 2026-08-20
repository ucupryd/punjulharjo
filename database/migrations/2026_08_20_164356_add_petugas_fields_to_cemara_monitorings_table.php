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
        Schema::table('cemara_monitorings', function (Blueprint $table) {
            $table->string('perkiraan_tinggi')->nullable()->after('tinggi_cm');
            $table->string('kondisi_daun')->nullable()->after('jumlah_daun');
            $table->string('cabang_baru')->nullable()->after('kondisi_daun');
            $table->string('kerusakan')->nullable()->after('cabang_baru');
            $table->string('nama_petugas')->nullable()->after('kerusakan');
            $table->string('tindakan_bibit_mati')->nullable()->after('nama_petugas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cemara_monitorings', function (Blueprint $table) {
            $table->dropColumn([
                'perkiraan_tinggi',
                'kondisi_daun',
                'cabang_baru',
                'kerusakan',
                'nama_petugas',
                'tindakan_bibit_mati',
            ]);
        });
    }
};
