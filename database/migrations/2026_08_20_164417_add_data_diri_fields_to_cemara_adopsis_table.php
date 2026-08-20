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
        Schema::table('cemara_adopsis', function (Blueprint $table) {
            $table->string('email_aktif')->nullable()->after('telepon');
            $table->string('status_pemesan')->nullable()->after('email_aktif');
            $table->string('nama_institusi')->nullable()->after('status_pemesan');
            $table->string('alamat_domisili')->nullable()->after('nama_institusi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cemara_adopsis', function (Blueprint $table) {
            $table->dropColumn([
                'email_aktif',
                'status_pemesan',
                'nama_institusi',
                'alamat_domisili',
            ]);
        });
    }
};
