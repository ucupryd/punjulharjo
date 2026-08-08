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
        Schema::create('view_logs', function (Blueprint $table) {
            $table->id();
            $table->string('viewable_type');
            $table->unsignedBigInteger('viewable_id');
            $table->string('visitor_token');
            $table->timestamps();

            // Indexes
            $table->index(['viewable_type', 'viewable_id']);
            $table->index('visitor_token');

            // Unique constraint
            $table->unique(['viewable_type', 'viewable_id', 'visitor_token'], 'viewable_visitor_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('view_logs');
    }
};
