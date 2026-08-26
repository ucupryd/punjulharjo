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
        Schema::create('karang_jahe_tikets', function (Blueprint $table) {
            $table->id();
            $table->string('komponen');
            $table->string('tarif');
            $table->string('catatan')->nullable();
            $table->string('ikon')->nullable();
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karang_jahe_tikets');
    }
};
