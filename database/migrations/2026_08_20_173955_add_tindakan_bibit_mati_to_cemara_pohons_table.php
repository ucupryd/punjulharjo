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
        Schema::table('cemara_pohons', function (Blueprint $table) {
            $table->string('tindakan_bibit_mati')->nullable()->after('status');
            $table->timestamp('tindakan_dikonfirmasi_at')->nullable()->after('tindakan_bibit_mati');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cemara_pohons', function (Blueprint $table) {
            $table->dropColumn(['tindakan_bibit_mati', 'tindakan_dikonfirmasi_at']);
        });
    }
};
