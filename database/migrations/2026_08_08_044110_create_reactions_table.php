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
        Schema::create('reactions', function (Blueprint $table) {
            $table->id();
            $table->string('reactable_type');
            $table->unsignedBigInteger('reactable_id');
            $table->string('type');
            $table->string('visitor_token')->index();
            $table->timestamps();

            $table->index(['reactable_type', 'reactable_id']);
            $table->unique(['reactable_type', 'reactable_id', 'visitor_token']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reactions');
    }
};
