<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Perluas enum sementara jadi superset (lama + baru)
        DB::statement("ALTER TABLE cemara_pohons MODIFY COLUMN status ENUM('menunggu_tanam','ditanam','tumbuh','mati','hidup','perlu_penyulaman') DEFAULT 'menunggu_tanam'");

        // 2. Migrasikan data lama ke value baru
        DB::table('cemara_pohons')->whereIn('status', ['ditanam', 'tumbuh'])->update(['status' => 'hidup']);

        // 3. Persempit enum ke set final
        DB::statement("ALTER TABLE cemara_pohons MODIFY COLUMN status ENUM('menunggu_tanam','hidup','mati','perlu_penyulaman') DEFAULT 'menunggu_tanam'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE cemara_pohons MODIFY COLUMN status ENUM('menunggu_tanam','ditanam','tumbuh','mati','hidup','perlu_penyulaman') DEFAULT 'menunggu_tanam'");
        DB::table('cemara_pohons')->where('status', 'hidup')->update(['status' => 'tumbuh']);
        DB::statement("ALTER TABLE cemara_pohons MODIFY COLUMN status ENUM('menunggu_tanam','ditanam','tumbuh','mati') DEFAULT 'menunggu_tanam'");
    }
};
