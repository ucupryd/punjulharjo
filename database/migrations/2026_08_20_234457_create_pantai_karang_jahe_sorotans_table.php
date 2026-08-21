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
        Schema::create('pantai_karang_jahe_sorotans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('judul');
            $table->text('deskripsi');
            $table->string('icon')->nullable(); // fallback fontawesome class jika gambar kosong
            $table->string('gambar')->nullable();
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pantai_karang_jahe_sorotans');
    }
};
