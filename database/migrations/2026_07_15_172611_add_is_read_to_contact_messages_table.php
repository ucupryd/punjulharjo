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
    Schema::table('contact_messages', function (Blueprint $table) {
        // Menambahkan kolom is_read bertipe boolean (0 = belum dibaca, 1 = sudah dibaca)
        $table->boolean('is_read')->default(0); 
    });
}

public function down(): void
{
    Schema::table('contact_messages', function (Blueprint $table) {
        $table->dropColumn('is_read');
    });
}
};
