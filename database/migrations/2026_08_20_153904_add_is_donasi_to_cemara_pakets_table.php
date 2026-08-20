<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cemara_pakets', function (Blueprint $table) {
            $table->boolean('is_donasi')->default(false)->after('aktif');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cemara_pakets', function (Blueprint $table) {
            $table->dropColumn('is_donasi');
        });
    }
};
